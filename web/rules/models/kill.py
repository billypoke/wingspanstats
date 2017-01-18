from rules.statsconfig import StatsConfig
class Kill(object):
    def __init__(
        self,
        kill_id,
        character_id,
        character_name,
        ship_type_id,
        solar_system_id,
        date,
        value,
        agent_id,
        attackers):
        self.kill_id = kill_id
        self.character_id = character_id
        self.character_name = character_name
        self.ship_type_id = ship_type_id
        self.solar_system_id = solar_system_id
        self.date = date
        self.value = value
        self.agent_id = agent_id
        self.attackers = []
        self.wingspanAgents = 0
        self.thirdParty = 0
        self.npc = 0
        self.totalDamage = 0
        for a in attackers:
            data = None
            if a['factionID'] != 0: 
                self.npc = self.npc + 1
                a['is_agent'] = 0              
            elif a['corporationID'] in StatsConfig.CORP_IDS: 
                self.wingspanAgents = self.wingspanAgents + 1
                a['is_agent'] = 1
            else: 
                self.thirdParty = self.thirdParty + 1
                a['is_agent'] = 0
            self.totalDamage = self.totalDamage + a['damageDone']
            if a['characterID'] != 0:
                data = {'killingBlow': a['finalBlow'],'character_id': a['characterID'],'character_name': a['characterName'],'corporation_id': a['corporationID'],'corporation_name':a['corporationName'],'ship_type_id':a['shipTypeID'],'damageDone':a['damageDone'],'is_agent': a['is_agent']}                        
                self.attackers.insert(1,data)
        totalAgents =  self.wingspanAgents + self.thirdParty 
        # print "{} /{}".format(totalAgents,self.wingspanAgents)        
        self.totalWingspanPct = round( self.wingspanAgents / float(totalAgents),3)
      

