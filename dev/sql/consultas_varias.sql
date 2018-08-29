# queries
# Obtiene el número de plaza(s) actual que ocupa el trabajador con clave=312224
SELECT b.clave, a.tipo_mov FROM rh_movimiento a INNER JOIN rh_plaza b 
ON a.id_plaza = b.id
WHERE a.clave_trab=312224 AND a.fec_inicio<=NOW() AND a.fec_termino>=NOW();


##
# El movimiento más reciente del trabajador con clave=452405
SELECT a.clave, b.fec_inicio, b.fec_termino, b.tipo_mov 
FROM rh_plaza a LEFT JOIN rh_movimiento b 
ON a.id=b.id_plaza 
WHERE b.clave_trab=452405 
ORDER BY fec_inicio DESC
LIMIT 1;



SELECT B.CLAVE, A.TIPO_MOV, A.FEC_INICIO, A.FEC_TERMINO 
FROM RH_MOVIMIENTO A INNER JOIN RH_PLAZA B 
ON A.ID_PLAZA = B.ID 
WHERE A.CLAVE_TRAB=566173 AND A.FEC_INICIO<= NOW() AND A.FEC_TERMINO>=NOW();

#
# Trabajador que actualmente ocupa la plaza=24028600  10027
SELECT A.clave_trab, CONCAT(B.nombre, ' ', B.ap_pat, ' ', B.ap_mat) AS Trabajador, A.id_ausencia 
FROM rh_movimiento A LEFT JOIN rh_trab B 
ON A.clave_trab=B.clave 
WHERE A.fec_inicio<=NOW() AND A.fec_termino>=NOW() AND A.id_plaza=
(SELECT id FROM rh_plaza WHERE clave='24028600  10027');
