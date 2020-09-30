<?php

namespace App\libraries\Utility;

use App\Models\Examination\ClassroomExaminationMapping;

/**
 * Class ExaminationUtility
 * @package App\libraries\Utility
 */
class ExaminationUtility
{
    public static function createClassroomExaminationMapping ($params)
    {
        $classroomExaminationMapping = new ClassroomExaminationMapping();

        foreach ( $params as $key => $value ) {
            $classroomExaminationMapping->$key = $value;
        }

        $classroomExaminationMapping->save();
    }
}