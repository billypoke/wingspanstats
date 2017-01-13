# astero.py
# Author: Valtyr Farshield

from skeleton import Skeleton
from statsconfig import StatsConfig


class Astero(Skeleton):

    def __init__(self):
        self.file_name = "astero.json"
        self.agent_ships_destroyed = {}
        self.agent_isk_destroyed = {}


    def __str__(self):
        output = "["

        output +=  "\n{\"title\": \n \"Top astero pilots - ships destroyed\", \n \"values\":[ " #'"Top Astero pilots - ships destroyed\n"
        # output += "--------------------------------------------\n"
        place = 0
        for w in sorted(
                self.agent_ships_destroyed,
                key=self.agent_ships_destroyed.get,
                reverse=True
        )[:StatsConfig.MAX_PLACES]:
            place += 1
            output += "\n{"
            output += '"place":'
            output += "\"{:02d}\"".format(place)
            output += ',"agent":'
            output += "\"{}\"".format(w)
            output += ',"noOfKills":'
            output += "\"{}\"".format(self.agent_ships_destroyed[w])
            output += "},"
        output = output.rstrip(",") 
        output += "\n"

        output += "]},"
        output += "\n{\n\"title\": \"Top Astero pilots - ISK destroyed \",\n\"values\":[ "
        output += ""
        place = 0
        for w in sorted(
                self.agent_isk_destroyed,
                key=self.agent_isk_destroyed.get,
                reverse=True
        )[:StatsConfig.MAX_PLACES]:
            place += 1
            output += "\n{"
            output += '"place":'
            output += "\"{:02d}\"".format(place)
            output += ',"agent":'
            output += "\"{}\"".format(w)
            output += ',"values":'
            output += "\"{:.2f}b\"".format(self.agent_isk_destroyed[w] / 1000000000.0)
            output += "},"
        output = output.rstrip(",") 
        output += "]}"
        output += "]"
        return output

    def process_km(self, killmail):
        isk_destroyed = killmail['zkb']['totalValue']

        for attacker in killmail['attackers']:
            attacker_name = attacker['characterName']
            attacker_corp = attacker['corporationID']
            attacker_ship = attacker['shipTypeID']

            if attacker_name != "" and attacker_corp in StatsConfig.CORP_IDS:
                if attacker_ship in [33468]:
                    if attacker_name in self.agent_ships_destroyed.keys():
                        self.agent_ships_destroyed[attacker_name] += 1
                    else:
                        self.agent_ships_destroyed[attacker_name] = 1

                    if attacker_name in self.agent_isk_destroyed.keys():
                        self.agent_isk_destroyed[attacker_name] += isk_destroyed
                    else:
                        self.agent_isk_destroyed[attacker_name] = isk_destroyed
