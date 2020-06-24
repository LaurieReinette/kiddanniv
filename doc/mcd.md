USER: mail, prénom, nom, mmemr, ville, département, phone, phone2, moderate, created_at,  fete_organisée_fk
ORGANISE, 11 FETE, 0N USER


FETE: date, heure_debut, heure_fin, age_enfant, nb_enfants, moderate, , type_lieu, prestation_fk, created_at, organisépar_fk, prestataire_fk
ANIMEE PAR, 0N PRESTATAIRE, 0N FETE
PRESTATAIRE: mail, prénom, nom, mmemr, entreprise, département_deplacement, phone, phone2, created_at, type_prestation_fk, animelafete_fk

PRESTATION:  age_min, age_max, , prix, moderate, created_at, propose-par_fk, type_prestation,

TYPE DE PRESTATIONS: name, pour_les_grands 
AVEC DES, 1N PRESTATION, 0N FETE

PROPOSEE PAR, 0N PRESTATAIRE, 1N PRESTATION