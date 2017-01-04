<?php

namespace Swd\SecuredBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Swd\CoreBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$default = new User();

		return $builder
			->add( 'id', HiddenType::class)
			->add( 'username', TextType::class, array( 'label' => 'Username (Email)', 'required' => true, 'attr' => array( 'placeholder' => 'Username', 'novalidate' => 'novalidate' ) ) )
			->add( 'save', SubmitType::class );
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => User::class,
		));
	}
}
