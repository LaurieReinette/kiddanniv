USER: mail, prénom, nom, mmemr, ville, département, phone, phone2, fete_organisée
ORGANISE, 11 FETE, 0N USER


FETE: date, heure, age_enfant, nb_enfants, type_lieu, prestation_fk, organisépar_fk, prestataire_fk
ANIMEE PAR, 0N PRESTATAIRE, 0N FETE
PRESTATAIRE: mail, prénom, nom, mmemr, entreprise, département_deplacement, phone, phone2, type_prestation_fk, animelafete_fk

PRESTATION: type, age_cible, pour_les_grands, prix, propose-par_fk
AVEC DES, 1N PRESTATION, 0N FETE

PROPOSEE PAR, 0N PRESTATAIRE, 1N PRESTATION