# -*- coding: utf-8 -*-

import gdata.spreadsheet.service


def main():
  print "Getting Lager..."
  gd_client = gdata.spreadsheet.service.SpreadsheetsService()
  gd_client.email = "fbsr.kerfis"
  gd_client.password = "patrol_fbsr5"
  gd_client.ProgrammaticLogin()
  print "Logged in..."
  #self.list_feed = None
  #self.curr_key = '0'
  #self.curr_wksht_id = '1'
  #spreadsheet = self.client.GetCellsFeed("0Av6QONyK5puVdFZob3U4cnpwbkt0YkxpRXY1VXY0U2c", "od6")
  #self.list_feed = self.gd_client.GetListFeed(self.curr_key, self.curr_wksht_id)
  #spreadsheet = gd_client.GetCellsFeed("0Av6QONyK5puVdFZob3U4cnpwbkt0YkxpRXY1VXY0U2c", "2")
  spreadsheet = gd_client.GetListFeed("0Av6QONyK5puVdFZob3U4cnpwbkt0YkxpRXY1VXY0U2c", "3") 
  #, "Lager")
  #self._PrintFeed(self.list_feed)
  #self.ExtractData(spreadsheet)
  #for i, entry in enumerate(spreadsheet.entry):
  #  print "["+str(i)+"] "+entry.content.text

  rows = spreadsheet.entry
  for row in rows:
    usable=""
    equip_type=""
    #for key in row.custom:
	#if key==u"nothæft":
	#  usable=row.custom[key].text
	#if key=="tegund":  
	#  equip_type=row.custom[key].text
        #print " %s: %s" % (key, row.custom[key].text)
    print row.custom[u"nothæft"].text+ " " + row.custom["tegund"].text 

if __name__ == '__main__':
  main()