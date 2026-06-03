<?php

// TOP ANOTADORES

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

e.nombre equipo,

SUM(es.puntos) total

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

INNER JOIN equipos e
ON j.equipo_id=e.id

GROUP BY j.id

ORDER BY total DESC

LIMIT 10

";

$anotadores = $pdo->query($sql)->fetchAll();


// TOP REBOTES

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

e.nombre equipo,

SUM(es.rebotes) total

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

INNER JOIN equipos e
ON j.equipo_id=e.id

GROUP BY j.id

ORDER BY total DESC

LIMIT 10

";

$rebotes = $pdo->query($sql)->fetchAll();


// TOP ASISTENCIAS

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

e.nombre equipo,

SUM(es.asistencias) total

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

INNER JOIN equipos e
ON j.equipo_id=e.id

GROUP BY j.id

ORDER BY total DESC

LIMIT 10

";

$asistencias = $pdo->query($sql)->fetchAll();


// TOP ROBOS

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

e.nombre equipo,

SUM(es.robos) total

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

INNER JOIN equipos e
ON j.equipo_id=e.id

GROUP BY j.id

ORDER BY total DESC

LIMIT 10

";

$robos = $pdo->query($sql)->fetchAll();


// TOP BLOQUEOS

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

e.nombre equipo,

SUM(es.bloqueos) total

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

INNER JOIN equipos e
ON j.equipo_id=e.id

GROUP BY j.id

ORDER BY total DESC

LIMIT 10

";

$bloqueos = $pdo->query($sql)->fetchAll();


// MVP

$sql = "

SELECT

j.id,
j.nombres,
j.apellidos,

SUM(

(es.puntos*1)+
(es.rebotes*1.2)+
(es.asistencias*1.5)+
(es.robos*2)+
(es.bloqueos*2)

) rating

FROM estadisticas_jugador es

INNER JOIN jugadores j
ON es.jugador_id=j.id

GROUP BY j.id

ORDER BY rating DESC

LIMIT 1

";

$mvp = $pdo->query($sql)->fetch();