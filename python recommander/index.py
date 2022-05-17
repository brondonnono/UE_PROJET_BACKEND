from flask import Flask, json, request, jsonify

app = Flask(__name__)

@app.route("/", methods=['GET'])
def hello_world():
    return "Hello, World!"

@app.route("/getOffer", methods=['GET'])
def getOffer():
    # offers, employee
    offers = {
        1 : [
            {
                1: 1,
                2: 1,
                3: [
                    "angular",
                    "laravel",
                    "sql"
                ]
            },
            {
                1: 2,
                2: 1,
                3: [
                    "angular",
                    "laravel",
                    "react"
                ]
            },
            {
                1: 3,
                2: 5,
                3: [
                    "angular",
                    "vuejs",
                    "sql"
                ]
            }
        ]
    }
    employee = {
        1: 1,
        2: [
            "angular",
            "ionic",
            "laravel",
            "sql",
            "react",
            "vuejs"
        ]
    }

    recommandation = []
    secondRecommandation = []

    r = 0

    for i in range(0,len(offers[1])):
        matchRate = 0
        for requirement in offers[1][i][3]:
            for competence in employee[2]:
                if ( competence == requirement ):
                    matchRate+=1
        if (matchRate == len(offers[1][i][3])):
            result = {
                'offers_id': offers[1][i][1],
                'employeur_id': offers[1][i][2],
                'offers_competences': offers[1][i][3],
                'matchRate': matchRate
            }
            recommandation.append(result)

        elif (matchRate >= 1 and matchRate < len(offers[1][i][3])):
            result = {
                'offers_id': offers[1][i][1],
                'employeur_id': offers[1][i][2],
                'offers_competences': offers[1][i][3],
                'matchRate': matchRate
            }
            secondRecommandation.append(result)

    recommandationOffers = {
        'user_id': employee[1],
        'user_competences': employee[2],
        'Size': len(recommandation),
        'Offres': recommandation,
        'Taille': len(secondRecommandation),
        'AutresOffres': secondRecommandation
    }

    if len(recommandation) == 0 and len(secondRecommandation) == 0:
        error = {"message": "Pour le moment aucune offre ne concorde avec vos compétences", "matchRate": matchRate}
        return jsonify(error)
    else:
        return jsonify(recommandationOffers)
