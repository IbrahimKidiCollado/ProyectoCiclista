<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        /*
        |--------------------------------------------------
        | CICLISTAS
        |--------------------------------------------------
        */
        DB::table('ciclista')->truncate();
        DB::table('ciclista')->insert([
            ['id'=>1,'nombre'=>'Juan','apellidos'=>'Pérez','fecha_nacimiento'=>'1990-05-10','peso_base'=>70.5,'altura_base'=>175,'email'=>'test1@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>2,'nombre'=>'Ana','apellidos'=>'Rodríguez','fecha_nacimiento'=>'1992-08-20','peso_base'=>60.0,'altura_base'=>165,'email'=>'test2@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>3,'nombre'=>'Pedro','apellidos'=>'García','fecha_nacimiento'=>'1995-03-15','peso_base'=>80.0,'altura_base'=>180,'email'=>'test3@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>4,'nombre'=>'Carmen','apellidos'=>'García','fecha_nacimiento'=>'1998-09-05','peso_base'=>55.0,'altura_base'=>160,'email'=>'test4@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>5,'nombre'=>'Luis','apellidos'=>'Rodríguez','fecha_nacimiento'=>'1972-09-15','peso_base'=>62.0,'altura_base'=>170,'email'=>'test5@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>6,'nombre'=>'Maria','apellidos'=>'Rodríguez','fecha_nacimiento'=>'1972-09-15','peso_base'=>62.0,'altura_base'=>170,'email'=>'test6@prueba.com','password'=>Hash::make('prueba')],
            ['id'=>7,'nombre'=>'Ricardo','apellidos'=>'García','fecha_nacimiento'=>'1982-09-15','peso_base'=>72.0,'altura_base'=>170,'email'=>'test7@prueba.com','password'=>Hash::make('prueba')],
        ]);

        /*
        |--------------------------------------------------
        | BICICLETAS
        |--------------------------------------------------
        */
        DB::table('bicicleta')->truncate();
        DB::table('bicicleta')->insert([
            ['id'=>1,'nombre'=>'Canyon','tipo'=>'carretera'],
            ['id'=>2,'nombre'=>'Orbea','tipo'=>'gravel'],
            ['id'=>3,'nombre'=>'Specialized','tipo'=>'mtb'],
        ]);

        /*
        |--------------------------------------------------
        | HISTORICO CICLISTA
        |--------------------------------------------------
        */
        DB::table('historico_ciclista')->truncate();
        DB::table('historico_ciclista')->insert([
            ['id_ciclista'=>1,'fecha'=>'2026-01-01','peso'=>72.5,'ftp'=>280,'pulso_max'=>185,'pulso_reposo'=>48,'potencia_max'=>1050,'grasa_corporal'=>14.5,'vo2max'=>62.3,'comentario'=>'Inicio de temporada'],
            ['id_ciclista'=>1,'fecha'=>'2026-02-01','peso'=>71.8,'ftp'=>290,'pulso_max'=>185,'pulso_reposo'=>46,'potencia_max'=>1100,'grasa_corporal'=>14.0,'vo2max'=>63.5,'comentario'=>'Mejora tras bloque base'],
            ['id_ciclista'=>1,'fecha'=>'2026-03-01','peso'=>70.9,'ftp'=>300,'pulso_max'=>186,'pulso_reposo'=>45,'potencia_max'=>1150,'grasa_corporal'=>13.6,'vo2max'=>65.0,'comentario'=>'Pico de forma'],
            ['id_ciclista'=>2,'fecha'=>'2026-01-15','peso'=>78.2,'ftp'=>250,'pulso_max'=>180,'pulso_reposo'=>52,'potencia_max'=>980,'grasa_corporal'=>16.8,'vo2max'=>58.0,'comentario'=>'Inicio plan umbral'],
            ['id_ciclista'=>2,'fecha'=>'2026-02-15','peso'=>77.5,'ftp'=>265,'pulso_max'=>181,'pulso_reposo'=>50,'potencia_max'=>1020,'grasa_corporal'=>16.0,'vo2max'=>59.5,'comentario'=>'Mejora progresiva'],
        ]);

        /*
        |--------------------------------------------------
        | PLAN ENTRENAMIENTO
        |--------------------------------------------------
        */
        DB::table('plan_entrenamiento')->truncate();
        DB::table('plan_entrenamiento')->insert([
            ['id'=>1,'id_ciclista'=>1,'nombre'=>'Plan Base Aeróbica 2026','descripcion'=>'Mejora de resistencia','fecha_inicio'=>'2026-01-01','fecha_fin'=>'2026-03-31','objetivo'=>'Base aeróbica','activo'=>1],
            ['id'=>2,'id_ciclista'=>2,'nombre'=>'Plan Umbral 2026','descripcion'=>'Trabajo de umbral','fecha_inicio'=>'2026-01-15','fecha_fin'=>'2026-04-15','objetivo'=>'Mejorar FTP','activo'=>1],
        ]);

        /*
        |--------------------------------------------------
        | BLOQUES ENTRENAMIENTO
        |--------------------------------------------------
        */
        DB::table('bloque_entrenamiento')->truncate();
        DB::table('bloque_entrenamiento')->insert([
            ['id'=>1,'nombre'=>'Calentamiento','descripcion'=>'Rodaje suave','tipo'=>'rodaje','duracion_estimada'=>'00:15:00','potencia_pct_min'=>55,'potencia_pct_max'=>65,'pulso_pct_max'=>70,'pulso_reserva_pct'=>50,'comentario'=>'Subir pulsaciones'],
            ['id'=>2,'nombre'=>'Rodaje Z2','descripcion'=>'Base aeróbica','tipo'=>'rodaje','duracion_estimada'=>'01:00:00','potencia_pct_min'=>65,'potencia_pct_max'=>75,'pulso_pct_max'=>80,'pulso_reserva_pct'=>65,'comentario'=>'Trabajo Z2'],
            ['id'=>3,'nombre'=>'Sweet Spot 8 min','descripcion'=>'Intervalos','tipo'=>'intervalos','duracion_estimada'=>'00:08:00','potencia_pct_min'=>88,'potencia_pct_max'=>94,'pulso_pct_max'=>90,'pulso_reserva_pct'=>80,'comentario'=>'Sweet spot'],
            ['id'=>4,'nombre'=>'Recuperación','descripcion'=>'Muy suave','tipo'=>'recuperacion','duracion_estimada'=>'00:05:00','potencia_pct_min'=>45,'potencia_pct_max'=>55,'pulso_pct_max'=>65,'pulso_reserva_pct'=>45,'comentario'=>'Eliminar fatiga'],
            ['id'=>5,'nombre'=>'Enfriamiento','descripcion'=>'Vuelta a la calma','tipo'=>'recuperacion','duracion_estimada'=>'00:10:00','potencia_pct_min'=>50,'potencia_pct_max'=>60,'pulso_pct_max'=>70,'pulso_reserva_pct'=>50,'comentario'=>'Normalizar pulsaciones'],
        ]);

        /*
        |--------------------------------------------------
        | ENTRENAMIENTOS
        |--------------------------------------------------
        */
        DB::table('entrenamiento')->truncate();
        DB::table('entrenamiento')->insert([
            ['id_ciclista'=>1,'id_bicicleta'=>1,'fecha'=>'2026-01-01 07:30:00','duracion'=>'01:45:00','kilometros'=>55.2,'recorrido'=>'Ruta Valle','pulso_medio'=>140,'pulso_max'=>170,'potencia_media'=>200,'potencia_normalizada'=>210,'velocidad_media'=>31.5,'puntos_estres_tss'=>60.5,'factor_intensidad_if'=>0.88,'ascenso_metros'=>800,'comentario'=>'Buen ritmo'],
            ['id_ciclista'=>2,'id_bicicleta'=>2,'fecha'=>'2026-01-02 08:00:00','duracion'=>'02:10:00','kilometros'=>72.0,'recorrido'=>'Sierra Norte','pulso_medio'=>145,'pulso_max'=>175,'potencia_media'=>210,'potencia_normalizada'=>220,'velocidad_media'=>32.0,'puntos_estres_tss'=>80.0,'factor_intensidad_if'=>0.91,'ascenso_metros'=>1200,'comentario'=>'Sensaciones normales'],
            ['id_ciclista'=>3,'id_bicicleta'=>3,'fecha'=>'2026-01-03 07:00:00','duracion'=>'01:30:00','kilometros'=>48.5,'recorrido'=>'Ruta Lago','pulso_medio'=>138,'pulso_max'=>165,'potencia_media'=>190,'potencia_normalizada'=>200,'velocidad_media'=>30.2,'puntos_estres_tss'=>55.0,'factor_intensidad_if'=>0.85,'ascenso_metros'=>500,'comentario'=>'Entrenamiento suave'],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
