<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reasons')->insert([
            [
                'reason' => 'Enfermedad, gravidez o maternidad, accidentes u otras causas previstas en la Ley del Seguro Social',
                'proof' => 'Los empleados tendrán derecho a gozar de licencia remunerada cuando conste acreditada y debidamente justificada cualquiera de las siguientes causas: Por enfermedad, gravidez o maternidad, accidentes u otras causas previstas en la Ley del Seguro Social y demás leyes de prevención social, de acuerdo con lo que allí se disponga. (Artículo 130, inciso 1, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Duelo por fallecimiento de parientes cercanos',
                'proof' => 'Si hubiere fallecido uno de los padres del servidor o uno de sus hijos, hermanos o su cónyuge o compañera o compañero de hogar, se concederán cinco (5) días hábiles de licencia; no obstante, si el fallecido hubiere habitado en lugar diferente al del domicilio del servidor, se podrán conceder hasta nueve (9) días hábiles, teniendo en cuenta la distancia y demás circunstancias que concurran. (Artículo 130, inciso 2, letra a, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Duelo por otros parientes',
                'proof' => 'Si ocurriere el fallecimiento de un pariente del empleado diferente a los anteriormente indicados, pero comprendido dentro del cuarto grado de consanguinidad o segundo de afinidad, podrán concederse hasta tres (3) días hábiles. (Artículo 130, inciso 2, letra b, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Matrimonio',
                'proof' => 'Por matrimonio, debiendo concederse licencia por seis (6) días hábiles cuando se tratare de primeras nupcias, o de tres (3) días hábiles si se tratare de segundas o posteriores. (Artículo 130, inciso 3, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Asistencia a eventos gremiales',
                'proof' => 'Para asistir a asambleas, congresos, reuniones de trabajo, cursos de capacitación u otros eventos similares, promovidos por la organización gremial legalmente reconocida a la que este afiliado el servidor, o para cumplir comisiones relacionadas con dicha organización. (Artículo 130, inciso 4, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Estudios y adiestramiento',
                'proof' => 'Si el servidor obtuviere una beca para hacer estudios dentro o fuera del país, siempre que el programa académico tuviere relación directa con la naturaleza de las funciones propias del cargo, podrá concederse licencia remunerada hasta por seis (6) meses, renovable hasta por un periodo similar. (Artículo 131, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Calamidades públicas o emergencia familiar',
                'proof' => 'En casos de calamidad pública, como inundaciones, terremotos, huracanes, epidemias u otras causas análogas, cuando el servidor o sus parientes resultaren afectados... O cuando el servidor tuviere que desempeñar servicios de socorro o de ayuda. (Artículo 134, inciso 3, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Enfermedad grave de familiares cercanos',
                'proof' => 'La enfermedad grave de cualquiera de los padres, hijos, hermanos, cónyuge o compañera o compañero de hogar del servidor, previa acreditación de la causa mediante certificación médica y evidencia de que fuere imprescindible su asistencia. (Artículo 134, inciso 4, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Comisiones especiales',
                'proof' => 'El desempeño de comisiones especiales, dentro o fuera del país, cuando fuere de interés para la Administración Pública. (Artículo 134, inciso 5, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Citación judicial o comparecencia ante organismos administrativos',
                'proof' => 'La comparecencia ante cualquier Tribunal de Justicia u Órgano Administrativo, cuando se conozca de un asunto en el que tenga interés legítimo y directo el servidor. (Artículo 134, inciso 1, del Reglamento de LSC)',
                'type' => 'Remunerada',
            ],
            [
                'reason' => 'Graves asuntos de familia diferentes a los indicados en las licencias remuneradas',
                'proof' => 'Graves asuntos de familia diferentes a los indicados en los Artículos ciento treinta (130), incisos 2) y 3) y ciento treinta cuatro (134), inciso 3) y 4), de este Reglamento. (Artículo 136, inciso 1, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
            [
                'reason' => 'Acompañamiento de cónyuge que estudie en el extranjero',
                'proof' => 'Necesidad familiar de acompañar a su cónyuge, cuando este último fuere becario o de otra manera hiciere estudios en el extranjero o en lugar distinto a aquél donde el servidor está destinado por razones de su cargo. (Artículo 136, inciso 2, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
            [
                'reason' => 'Participación en programas de adiestramiento no relacionados con el cargo',
                'proof' => 'Participación en programas de adiestramiento planificados o programados por organismos no sujetos a la Ley y sobre materias que no tengan relación directa con las funciones propias del cargo. (Artículo 136, inciso 3, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
            [
                'reason' => 'Invitación a eventos por gobiernos extranjeros u organismos no relacionados con el cargo',
                'proof' => 'Invitación de Gobiernos extranjeros, organismos internacionales, u otros organismos públicos o privados para participar en otros eventos que tampoco tengan relación directa con las funciones propias del cargo. (Artículo 136, inciso 4, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
            [
                'reason' => 'Comisiones especiales no relacionadas con el cargo',
                'proof' => 'Participación en comisiones especiales diferentes a las previstas en el Artículo ciento treinta (130), inciso 4) y ciento treinta y cuatro (134), inciso 5) de este Reglamento. (Artículo 136, inciso 5, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
            [
                'reason' => 'Otras circunstancias de interés personal',
                'proof' => 'Otras circunstancias calificadas en las que prevalezca el interés personal del servidor y no el de la Administración Pública, siempre que no se ponga en precario el servicio. (Artículo 136, inciso 6, del Reglamento de LSC)',
                'type' => 'No Remunerada',
            ],
        ]);
    }
}
