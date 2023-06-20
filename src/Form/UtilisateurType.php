<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UtilisateurType extends AbstractType
{
    private $userRepo;

    public function __construct(UtilisateurRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('email')

//            ->add('password')
//            ->add('isVerified')
            ->add('roles', ChoiceType::class, array(
                'attr' => array(
                    'required' => false,
                ),
                'multiple' => true,
                'expanded' => true, // render check-boxes
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'user' => 'ROLE_USER',
                ]
            ))
        ;
//        $builder->get('roles')
//            ->addModelTransformer(new CallbackTransformer(
//                function ($rolesAsArray) {
//                    return count($rolesAsArray) ? $rolesAsArray[0]: null;
//                },
//                function ($rolesAsString) {
//                    return [$rolesAsString];
//                }
//            ));
    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
