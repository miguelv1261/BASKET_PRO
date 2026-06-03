SELECT

v.*,
e.nombre

FROM vw_posiciones v

INNER JOIN equipos e
ON v.equipo_id=e.id

ORDER BY puntos DESC,
(pg-pp) DESC