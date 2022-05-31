<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class reservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateTimeType::class)
            ->add('comensales', IntegerType::class,array('label'=>"Número de Comensales"))
            ->add('observaciones', TextareaType::class, array('label'=>'Observaciones'))
            ->add('guardar', SubmitType::class, array('label'=> "Reservar"));
    }
}
?>