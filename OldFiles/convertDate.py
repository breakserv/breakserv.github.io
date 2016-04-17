import csv, os, sys, gc, re, string

Oldfile = "C:\\SHUYANG\\SENIOR\\ORF 401 eCommerce\\Lab 2\\oldtripdb.csv"
Newfile = "C:\\SHUYANG\\SENIOR\\ORF 401 eCommerce\\Lab 2\\tripdb.csv"

alllines = open(Oldfile, 'r').readlines()

with open(Newfile, 'wb') as newcsv:
	neWrite = csv.writer(newcsv, delimiter=',')
	for line in alllines:
		newlist = []
		for token in line.split(','):
			# Original in mm/dd/yyyy -> we want yyyy-mm-dd
			if '/' in token:
				sections = token.split('/')
				newlist += [sections[2] + "-" + sections[0] + "-" + sections[1]]
			else:
				newlist += [token.strip("\n")]
		print line.split(',')
		print newlist
		neWrite.writerow(newlist)