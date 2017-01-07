<?php

namespace Swd\SecuredBundle\Forms;

use Swd\CoreBundle\Services\CommonService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Entity\Role;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//$default = new User();
		$roles = $this->container->get( 'swd_core_role_service' )->getRoles();
		//CommonService::debug( $roles ); exit;

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

		$builder->add('roles', ChoiceType::class, [
			'choices' => [$roles],
			'multiple' => true,
			'choice_label' => function($role, $key, $index) {
				/** @var Role $role */
				return strtoupper($role->getName());
			},
			'choice_attr' => function($role, $key, $index) {
				return ['class' => 'category_'.strtolower($role->getName())];
			},
			'group_by' => function($role, $key, $index) {
				// randomly assign things into 2 groups
				return rand(0, 1) == 1 ? 'Group A' : 'Group B';
			},
			'preferred_choices' => function($role, $key, $index) {
				return $role->getName() == 'Cat2' || $role->getName() == 'Cat3';
			},
		]);

		return $builder;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => User::class,
		));
	}
}
