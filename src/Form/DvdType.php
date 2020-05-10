<?php

namespace App\Form;

use App\Entity\Dvd;
use App\Entity\DvdType as DvdTypeEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DvdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration(
                'Titre du film',
                'Exemple : Sweeney Todd'
            ))
            ->add('type', EntityType::class, [
                'class' => DvdTypeEntity::class,
                'choice_label' => 'name',
            ])
            ->add('comment', TextType::class, $this->getConfiguration(
                'Emplacement',
                'Exemple : Étagère de gauche, en haut, devant'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dvd::class,
        ]);
    }

    /**
     * Permet de configurer le label et le placeholder d'un champ input
     *
     * @param string $label
     * @param string $placeholder
     *
     * @return array<string>
     */
    private function getConfiguration($label, $placeholder): array
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder,
            ],
        ];
    }
}
