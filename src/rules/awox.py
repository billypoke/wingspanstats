# awox.py
# Author: Valtyr Farshield

from skeleton import Skeleton
from statsconfig import StatsConfig


class Awox(Skeleton):

    def __init__(self):
        self.file_name = "top_awox.json"
        self.awox_kills = {}

    def __str__(self):
        output = "["
        output += "\n { \"title\": \"Top AWOX Kills\","
        output += "\"filename\":\"{}\",".format(self.file_name)
        output += "\n\"values\":[ "
        
        place = 0
        for w in sorted(
                self.awox_kills.keys(),
                key=lambda k: self.awox_kills[k][1],
                reverse=True
        )[:StatsConfig.MAX_PLACES]:
            place += 1
            output += "\n{"
            output += '"place":'
            output += "\"{:02d}\"".format(place)
            output += ',"link":'
            output += "\"https://zkillboard.com/kill/{}/\"".format(w)
            output += ',"agent":'
            output += "\"{}\"".format(self.awox_kills[w][0])
            output += ',"value":'
            output += "\"{:.2f}m\"".format(self.awox_kills[w][1] / 1000000.0)
            output += "},"

            # output += "#{:02d} - https://zkillboard.com/kill/{}/ - {} - {:.2f}m\n".format(
            #     place,
            #     w,
            #     self.awox_kills[w][0],
            #     self.awox_kills[w][1] / 1000000.0,
            # )
        output = output.rstrip(",") 
        output += "\n]" #close the array
        output +="\n}]"
        return output

    def process_km(self, killmail):
        if killmail['victim']['corporationID'] in StatsConfig.CORP_IDS:
            kill_id = killmail['killID']
            isk_destroyed = killmail['zkb']['totalValue']
            victim_name = killmail['victim']['characterName']

            self.awox_kills[kill_id] = [victim_name, isk_destroyed]
