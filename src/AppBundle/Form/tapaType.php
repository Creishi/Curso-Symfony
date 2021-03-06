<?php
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class tapaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('descripcion', TextareaType::class)
            ->add('ingredientes', EntityType::class, array('class' => 'AppBundle:Ingrediente','multiple' => true))
            ->add('categoria', EntityType::class, array('class' => 'AppBundle:Categoria'))
            ->add('foto', FileType::class, array('attr'=>array('onChange'=>'onChange(event)')))
            ->add('top')
            ->add('guardar', SubmitType::class, array('label'=> 'Nueva Tapa'));
    }
}