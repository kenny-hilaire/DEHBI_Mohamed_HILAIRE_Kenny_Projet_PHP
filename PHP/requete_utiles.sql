requete sql qui seront utiles



--------------------Nb titularisation d'un joueur:--------------------------------

create or replace function nombreMatchTitulaire(p_idJoueur in Joueur.id_Joeur%type)return int is


v_nb_titu int;

select count(*) from Participe P into v_nb_titu
where p_idJoueur = P.id_Joueur
and P.titulaire_ou_remplaçant = "titulaire";

return v_nb_titu ;
end;


-----------------------------Nb remplaçant d'un joueur:--------------------------------


create or replace function nombreMatchRemplaçant(p_idJoueur in Joueur.id_Joeur%type)return int is


v_nb_remp int;

select count(*) from Participe P, Joueur J into v_nb_emp
where J.id_Joueur = P.id_Joueur
and P.titulaire_ou_remplaçant = "remplacant";

return v_nb_remp;

when no_data_found 
	raise_application_error("Ce joueur n'existe pas");
end;
end;

----------------------------Nb de match gagné--------------------------------
create or replace function nombre_victoire ()is

v_total INT;
v_nb_victoire int;

begin 

SELECT COUNT(*) INTO v_total FROM Match;
select count(*) into v_nb_victoire
from match
where resultat = "victoire";

IF v_total = 0 THEN RETURN 0; END IF;
    
    RETURN ROUND((v_victoires / v_total) * 100, 2);
end;

---------------------------------Nb de match null---------------------------------
create or replace function nombre_draw ()is

v_nb_draw int;
v_total INT;

SELECT COUNT(*) INTO v_total FROM Match;

select count(*) into v_nb_draw
from match
where resultat = "egalte";

if v_nb_draw is null then
	v_nb_draw = 0;
end if;

RETURN ROUND((v_nb_draw / v_total) * 100, 2);
end;

--------------------------------Nb de match perdu----------------------------------
create or replace function nombre_perdu ()is

v_nb_perdu
v_total INT;

SELECT COUNT(*) INTO v_total FROM Match;

select count(*) into v_nb_perdu
from match
where resultat = "egalte";

if v_nb_perdu is null then
	v_nb_perdu = 0;
end if;
RETURN ROUND((v_nb_perdu / v_total) * 100, 2);

end;


------------------------Nb victoire_ouJoueur_a_participer-----------------------

CREATE OR REPLACE FUNCTION pourcentage_victoire_joueur(p_idJoueur IN VARCHAR2) RETURN NUMBER IS
    v_participations INT;
    v_victoires INT;
BEGIN
    -- Nombre total de matchs joués par ce joueur
    SELECT COUNT(*) INTO v_participations 
    FROM Participe 
    WHERE Id_Joueur = p_idJoueur;

    -- Nombre de ces matchs qui se sont finis par une victoire
    SELECT COUNT(*) INTO v_victoires 
    FROM Participe P
    JOIN Match M ON P.Id_Match = M.Id_Match
    WHERE P.Id_Joueur = p_idJoueur AND M.resultat = 'victoire';

    IF v_participations = 0 THEN RETURN 0; END IF;

    RETURN ROUND((v_victoires / v_participations) * 100, 2);
END;
----il reste evluation à faire 

CREATE OR REPLACE FUNCTION moyenneEvaluation(p_idJoueur IN VARCHAR2) RETURN NUMBER IS
    v_moyenne NUMBER;
BEGIN
    SELECT AVG(TO_NUMBER(evaluation_perf)) INTO v_moyenne -- TO_NUMBER si c'est stocké en VARCHAR
    FROM Participe 
    WHERE Id_Joueur = p_idJoueur;

    RETURN NVL(v_moyenne, 0); -- Retourne 0 si aucune note
END;

