def chargerCompteur():
	try:
		with open("/var/www/DataFromHCR2Adventure/data/logs/compteur.txt", "r") as fichier:
			compteur = int(fichier.read())
			fichier.close()
			enregistrerCompteur(compteur +1)
			
	except FileNotFoundError:
		with open("/var/www/DataFromHCR2Adventure/data/logs/compteur.txt", "w") as fichier:
			fichier.write(str(10000000))
			fichier.close()
			compteur = chargerCompteur()
			
	return str(compteur)


def enregistrerCompteur(compteur):
	with open("/var/www/DataFromHCR2Adventure/data/logs/compteur.txt", "w") as fichier:
		fichier.write(str(compteur))
		fichier.close()
	
	return
		

# TEST #
#compteur = chargerCompteur()
#enregistrerCompteur(10000000000)
