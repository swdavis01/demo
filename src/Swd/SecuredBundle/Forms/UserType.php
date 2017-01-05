<?php

namespace Swd\SecuredBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Swd\CoreBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$default = new User();

		$builder
			->add( 'id', HiddenType::class)
			->add( 'name', TextType::class, array( 'label' => 'Name', 'required' => true, 'attr' => array( 'placeholder' => 'name', 'novalidate' => 'novalidate' ) ) )
			->add( 'username', TextType::class, array( 'label' => 'Username (Email)', 'required' => true, 'attr' => array( 'placeholder' => 'username', 'novalidate' => 'novalidate' ) ) )
			->add( 'save', SubmitType::class );

		$builder->add('password', RepeatedType::class, array(
			'type' => PasswordType::class,
			'invalid_message' => 'The password fields must match',
			'options' => array('attr' => array('class' => 'password-field')),
			'required' => false,
			'first_options'  => array('label' => 'Password'),
			'second_options' => array('label' => 'Repeat Password'),
		));

		return $builder;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => User::class,
		));
	}
}
