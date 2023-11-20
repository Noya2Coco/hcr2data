import matplotlib.pyplot as plt
import matplotlib.dates as mdates
from matplotlib.ticker import FuncFormatter

import numpy as np
from scipy.interpolate import make_interp_spline

import pandas as pd
import os
from datetime import datetime




def millions(x, pos):
    'Les étiquettes d\'axe doivent être affichées en millions'
    return f'{x / 1e6:.1f}M'


def whereFileData(fileName):
    folderTest = '../data/dataMonthly/'
    folderContent = os.listdir(folderTest)
    
    if fileName in folderContent:
        dataFolderPath = '../data/dataMonthly/'
        graphFolderPath = '../data/graphMonthly/'
    else:
        dataFolderPath = '../data/newDataMonthly/'
        graphFolderPath = '../data/newGraphMonthly/'
    
    return dataFolderPath, graphFolderPath
    
    
def createGraph(fileName, lastDays = False, notAllDays = False):
    #dataFolderPath, graphFolderPath = whereFileData(fileName)
    dataFolderPath = '../data/dataMonthly/'
    graphFolderPath = '../data/graphMonthly/'

    allData = pd.read_excel(dataFolderPath + fileName)
    
    players = allData.iloc[1:, 0].tolist()
    days = allData.iloc[0, 1:].tolist()
    playersData = []
       
    for i in range(1, len(allData)):
        playersData.append(allData.iloc[i, 1:].tolist())
        
    if notAllDays == True:
        newPlayersData = []
        days = days[(len(playersData[0]) - 5):]
                   
        for i in playersData:
            newPlayersData.append(playerData[(len(playersData[0]) - 5):])
        playersData = newPlayersData
    
    if len(players) >10:
        playersData = playersData[:10]
        players = players[:10]
             
    if lastDays == True:
        fileMonth = fileName[3:5]
        
        for i in range(len(days)):
            days[i] = str(fileMonth) + '-' + str(days[i])    
            print(days[i])
                
        # Convertir les chaînes de dates en objets datetime
        days = [mdates.datestr2num(day) for day in days]     
                
    plt.figure(figsize=(10, 6))

    markers = ['o', 's', '^', 'v', '>', '<']
    for i in range(len(playersData)) :
        # Crée un graphique linéaire
        plt.plot(days, playersData[i], marker=markers[i//10], markersize=3,
            label= players[i], linewidth=1, linestyle='-')
            

    # Ajoute un titre et des labels d'axe
    plt.title('Evolution of player scores',fontsize=16)
    plt.xlabel('Days', fontsize=12)
    plt.ylabel('Number of stars', fontsize=12)

    # Formater l'axe des ordonnées avec des jours et des mois
    plt.gca().xaxis.set_major_formatter(mdates.DateFormatter('%m-%d'))
    
    # Personnalisation des axes
    plt.xticks(fontsize=10)
    plt.yticks(fontsize=10)

    # Changer les valeurs verticales vers ...M
    formatter = FuncFormatter(millions)
    plt.gca().yaxis.set_major_formatter(formatter)
    
    plt.legend(loc='center left', bbox_to_anchor=(1, 0.5), fontsize=12, title="Players")

    # Retire les bords du graphique
    plt.gca().spines['top'].set_visible(False)
    plt.gca().spines['right'].set_visible(False)

    # Ajoute une grille de fond
    plt.grid(True, linestyle='--', alpha=0.6)
        
        
    if lastDays == True:
        graphFolderPath += 'lastDays/'
        fileName = 'lastDay.xlsx'
        #fileName = datetime.now().strftime("%y-%m-%d") + '.xlsx'
        
    newFileName, extension = os.path.splitext(os.path.basename(fileName))
    plt.savefig(graphFolderPath + newFileName, bbox_inches='tight')

    #print("Graph " + fileName + " créé")
    return
   
   
# Utilitaire pour créer tous les graph manquant parmis les 
# data du dossier 'dataMonthly'
def createAllGraph():
    dataFolderPath = '../data/dataMonthly/'
    dataFolderContent = [file.split('.')[0] for file in os.listdir(dataFolderPath) if file.endswith(".xlsx")]

    graphFolderPath = '../data/graphMonthly/'
    graphFolderContent = [file.split('.')[0] for file in os.listdir(graphFolderPath) if file.endswith(".png")]
    
    for dataFile in dataFolderContent:
        if dataFile not in graphFolderContent:
            createGraph(dataFile + '.xlsx')
    
    return
    
    
def createLastDaysGraph():
    folder = '../data/dataMonthly/'
    allFiles = [file for file in os.listdir(folder) if os.path.isfile(os.path.join(folder, file))]


    lastFile = allFiles[-1]
    lastDaysData = []
        
    allData = pd.read_excel(folder + lastFile)
    days = allData.iloc[0, 1:].tolist()
    
    nbDays = 0
    if len(days) >= 5:
        createGraph(lastFile, lastDays = True, notAllDays = True)
    else:
        createGraph(lastFile, lastDays = True)
        
    
    #print(len(pd.read_excel(folder + lastFile)['Zorro']))
    #print(pd.read_excel(folder + lastFile)['Zorro'])

    


    
def recreateAllGraph():
    dataFolderPath = '../data/dataMonthly/'
    dataFolderContent = [file.split('.')[0] for file in os.listdir(dataFolderPath) if file.endswith(".xlsx")]

    for dataFile in dataFolderContent:
        createGraph(dataFile + '.xlsx')
    
    return
   
   
createLastDaysGraph()
createAllGraph()
#recreateAllGraph()

