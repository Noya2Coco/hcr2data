import matplotlib.pyplot as plt
import numpy as np
from scipy.interpolate import make_interp_spline

import pandas as pd
import os

from matplotlib.ticker import FuncFormatter



def millions(x, pos):
    'Les étiquettes d\'axe doivent être affichées en millions'
    return f'{x / 1e6:.1f}M'


def whereFileData(fileName):
    folderTest = 'data/dataMonthly/'
    folderContent = os.listdir(folderTest)
    
    if fileName in folderContent:
        dataFolderPath = 'data/dataMonthly/'
        graphFolderPath = 'html/images/graphMonthly/'
    else:
        dataFolderPath = 'data/newDataMonthly/'
        graphFolderPath = 'data/newGraphMonthly'
    
    return dataFolderPath, graphFolderPath
    
    
def createGraph(fileName):
    #dataFolderPath, graphFolderPath = whereFileData(fileName)
    dataFolderPath = 'data/dataMonthly/'
    graphFolderPath = 'html/images/graphMonthly/'
    
    allData = pd.read_excel(dataFolderPath + fileName)
    
    players = allData.iloc[1:, 0].tolist()
    days = allData.iloc[0, 1:].tolist()
    playersData = []
       
    for i in range(1, len(allData)):
        playersData.append(allData.iloc[i, 1:].tolist())

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
        
        
    newFileName, extension = os.path.splitext(os.path.basename(fileName))
    plt.savefig(graphFolderPath + newFileName, bbox_inches='tight')

    #print("Graph " + fileName + " créé")
    return
    
  
# Utilitaire pour créer tous les graph manquant parmis les 
# data du dossier 'dataMonthly'
def createAllGraph():
    dataFolderPath = 'data/dataMonthly/'
    dataFolderContent = [file.split('.')[0] for file in os.listdir(dataFolderPath) if file.endswith(".xlsx")]

    graphFolderPath = 'html/images/graphMonthly/'
    graphFolderContent = [file.split('.')[0] for file in os.listdir(graphFolderPath) if file.endswith(".png")]
    
    for dataFile in dataFolderContent:
        if dataFile not in graphFolderContent:
            createGraph(dataFile + '.xlsx')
    
    return
    
    
def recreateAllGraph():
    dataFolderPath = 'data/dataMonthly/'
    dataFolderContent = [file.split('.')[0] for file in os.listdir(dataFolderPath) if file.endswith(".xlsx")]

    for dataFile in dataFolderContent:
        createGraph(dataFile + '.xlsx')
    
    return
   
   
createAllGraph()
#recreateAllGraph()

