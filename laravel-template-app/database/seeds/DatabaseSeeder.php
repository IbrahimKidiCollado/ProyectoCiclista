<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ['id_ciclista'=>1,'fecha'=>'2026-01-01','peso'=>72.5,'ftp'=>280,'pulso_max'=>185,'pulso_reposo'=>48,'potencia_max'=>1050,'grasa_corporal'=>14.5,'vo2max'=>62.3,'comentario'=>'Inicio temporada'],
            ['id_ciclista'=>1,'fecha'=>'2026-02-01','peso'=>71.8,'ftp'=>290,'pulso_max'=>185,'pulso_reposo'=>46,'potencia_max'=>1100,'grasa_corporal'=>14.0,'vo2max'=>63.5,'comentario'=>'Mejora'],
        ]);

        /*
        |--------------------------------------------------
        | PLAN ENTRENAMIENTO
        |--------------------------------------------------
        */
        DB::table('plan_entrenamiento')->truncate();
        DB::table('plan_entrenamiento')->insert([
            ['id'=>1,'id_ciclista'=>1,'nombre'=>'Plan Base 2026','descripcion'=>'Base aeróbica','fecha_inicio'=>'2026-01-01','fecha_fin'=>'2026-03-31','objetivo'=>'Resistencia','activo'=>1],
            ['id'=>2,'id_ciclista'=>2,'nombre'=>'Plan Umbral 2026','descripcion'=>'Trabajo FTP','fecha_inicio'=>'2026-01-15','fecha_fin'=>'2026-04-15','objetivo'=>'FTP','activo'=>1],
        ]);

        /*
        |--------------------------------------------------
        | BLOQUES ENTRENAMIENTO
        |--------------------------------------------------
        */
        DB::table('bloque_entrenamiento')->truncate();
        DB::table('bloque_entrenamiento')->insert([
            ['id'=>1,'nombre'=>'Calentamiento','descripcion'=>'Rodaje suave','tipo'=>'rodaje','duracion_estimada'=>'00:15:00','potencia_pct_min'=>55,'potencia_pct_max'=>65,'pulso_pct_max'=>70,'pulso_reserva_pct'=>50,'comentario'=>'Subir pulsaciones'],
            ['id'=>2,'nombre'=>'Rodaje Z2','descripcion'=>'Base','tipo'=>'rodaje','duracion_estimada'=>'01:00:00','potencia_pct_min'=>65,'potencia_pct_max'=>75,'pulso_pct_max'=>80,'pulso_reserva_pct'=>65,'comentario'=>'Zona 2'],
            ['id'=>3,'nombre'=>'Sweet Spot','descripcion'=>'Intervalos','tipo'=>'intervalos','duracion_estimada'=>'00:08:00','potencia_pct_min'=>88,'potencia_pct_max'=>94,'pulso_pct_max'=>90,'pulso_reserva_pct'=>80,'comentario'=>'Sweet spot'],
            ['id'=>4,'nombre'=>'Recuperación','descripcion'=>'Suave','tipo'=>'recuperacion','duracion_estimada'=>'00:05:00','potencia_pct_min'=>45,'potencia_pct_max'=>55,'pulso_pct_max'=>65,'pulso_reserva_pct'=>45,'comentario'=>'Recuperar'],
        ]);

        /*
        |--------------------------------------------------
        | SESIONES ENTRENAMIENTO
        |--------------------------------------------------
        */
        DB::table('sesion_entrenamiento')->truncate();
        DB::table('sesion_entrenamiento')->insert([
            ['id'=>1,'id_plan'=>1,'fecha'=>'2026-01-05','nombre'=>'Rodaje Base','descripcion'=>'Trabajo Z2','completada'=>1],
            ['id'=>2,'id_plan'=>1,'fecha'=>'2026-01-07','nombre'=>'Sweet Spot','descripcion'=>'3x8min','completada'=>0],
            ['id'=>3,'id_plan'=>2,'fecha'=>'2026-01-20','nombre'=>'Trabajo FTP','descripcion'=>'4x10min','completada'=>1],
        ]);

        /*
        |--------------------------------------------------
        | SESION BLOQUE
        |--------------------------------------------------
        */
        DB::table('sesion_bloque')->truncate();
        DB::table('sesion_bloque')->insert([
            ['id_sesion_entrenamiento'=>1,'id_bloque_entrenamiento'=>1,'orden'=>1,'repeticiones'=>1],
            ['id_sesion_entrenamiento'=>1,'id_bloque_entrenamiento'=>2,'orden'=>2,'repeticiones'=>1],

            ['id_sesion_entrenamiento'=>2,'id_bloque_entrenamiento'=>1,'orden'=>1,'repeticiones'=>1],
            ['id_sesion_entrenamiento'=>2,'id_bloque_entrenamiento'=>3,'orden'=>2,'repeticiones'=>3],
            ['id_sesion_entrenamiento'=>2,'id_bloque_entrenamiento'=>4,'orden'=>3,'repeticiones'=>3],
        ]);

        /*
        |--------------------------------------------------
        | TIPO COMPONENTE
        |--------------------------------------------------
        */
        DB::table('tipo_componente')->truncate();
        DB::table('tipo_componente')->insert([
            ['id'=>1,'nombre'=>'Cadena','descripcion'=>'Transmisión'],
            ['id'=>2,'nombre'=>'Cassette','descripcion'=>'Piñones'],
            ['id'=>3,'nombre'=>'Platos','descripcion'=>'Platos delanteros'],
            ['id'=>4,'nombre'=>'Pastillas','descripcion'=>'Frenos'],
            ['id'=>5,'nombre'=>'Cubiertas','descripcion'=>'Neumáticos'],
        ]);

        /*
|--------------------------------------------------
| COMPONENTES BICICLETA (CORRECTO SEGÚN MIGRACIÓN)
|--------------------------------------------------
*/
DB::table('componentes_bicicleta')->truncate();
DB::table('componentes_bicicleta')->insert([
    [
        'id_bicicleta' => 1,
        'id_tipo_componente' => 1,
        'marca' => 'Shimano',
        'modelo' => 'Ultegra',
        'especificacion' => null,
        'velocidad' => '11v',
        'estado' => 'Nuevo',
        'fecha_montaje' => '2026-01-01',
        'fecha_retiro' => null,
        'km_actuales' => 1200,
        'km_max_recomendado' => 3000,
        'activo' => 1,
        'comentario' => null,
    ],
    [
        'id_bicicleta' => 2,
        'id_tipo_componente' => 5,
        'marca' => 'Continental',
        'modelo' => 'GP5000',
        'especificacion' => null,
        'velocidad' => null,
        'estado' => 'En uso',
        'fecha_montaje' => '2026-02-01',
        'fecha_retiro' => null,
        'km_actuales' => 800,
        'km_max_recomendado' => 4000,
        'activo' => 1,
        'comentario' => null,
    ],
]);

        /*
        |--------------------------------------------------
        | RESULTADOS (EJECUCIÓN REAL)
        |--------------------------------------------------
        */
        DB::table('resultados')->truncate();
        DB::table('resultados')->insert([
            [
                'id_ciclista' => 1,
                'id_sesion' => 1,    // Vinculado a "Rodaje Base"
                'fecha' => '2026-01-05',
                'duracion_real' => '01:15:00',
                'distancia_total' => 35.50,
                'potencia_media' => 195,
                'pulso_medio' => 135,
                'calorias' => 750,
                'esfuerzo_percibido' => 4,
                'comentarios_post_entreno' => 'Rodaje cómodo, buenas sensaciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ciclista' => 1,
                'id_sesion' => 2,    // Vinculado a "Sweet Spot"
                'fecha' => '2026-01-07',
                'duracion_real' => '00:55:00',
                'distancia_total' => 28.20,
                'potencia_media' => 230,
                'pulso_medio' => 155,
                'calorias' => 680,
                'esfuerzo_percibido' => 8,
                'comentarios_post_entreno' => 'Intervalos duros, pero mantenidos en vatios.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ciclista' => 2,
                'id_sesion' => null, // Salida libre (sin sesión previa)
                'fecha' => '2026-01-20',
                'duracion_real' => '02:30:00',
                'distancia_total' => 65.00,
                'potencia_media' => 160,
                'pulso_medio' => 125,
                'calorias' => 1200,
                'esfuerzo_percibido' => 6,
                'comentarios_post_entreno' => 'Salida de fin de semana por pistas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
}
