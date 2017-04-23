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
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
		$user = $options['data'];
		//$default = new User();
		//$roles = $this->container->get( 'swd_core_role_service' )->getUserRoles( $user->getId() );

		$builder
			->add( 'id', HiddenType::class)
			->add( 'name', TextType::class, array( 'label' => 'Name', 'required' => true, 'attr' => array( 'placeholder' => 'name', 'novalidate' => 'novalidate' ) ) )
			->add( 'asset', FileType::class, array( 'label' => 'Icon', 'required' => false, 'attr' => array( 'placeholder' => 'icon', 'novalidate' => 'novalidate' ) ) )
			->add( 'username', TextType::class, array( 'label' => 'Username (Email)', 'required' => true, 'attr' => array( 'placeholder' => 'username', 'novalidate' => 'novalidate' ) ) )
			->add( 'save', SubmitType::class );

		if ( $user->getId() == 0 || strlen( $user->getPassword() ) == 0 )
		{
			$builder->add('password', RepeatedType::class, array(
				'type' => PasswordType::class,
				'invalid_message' => 'The password fields must match',
				'options' => array('attr' => array('class' => 'password-field')),
				'required' => false,
				'first_options'  => array('label' => 'Password'),
				'second_options' => array('label' => 'Repeat Password'),
			));
		}
		else
		{
			$builder->add( 'password', HiddenType::class);
		}

		/*$builder->add('userRoles', ChoiceType::class, [
			'choices' => $roles,
			'expanded' => true,
			'multiple' => true,
			'data' => array(),
			'choice_label' => function($userRole, $key, $index) {
				return strtoupper($userRole->getRole()->getName());
			},
			'choice_attr' => function($userRole, $key, $index) {
				return ['class' => 'role_'.strtolower($userRole->getRole()->getName())];
			},
			'group_by' => function($userRole, $key, $index) {
				return $userRole->getRole()->getSection();
			},
		]);*/

		return $builder;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => User::class,
		));
	}
}
