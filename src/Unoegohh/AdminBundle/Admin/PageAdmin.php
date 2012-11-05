<?php
namespace Unoegohh\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class PageAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('enabled', null, array('required' => false, 'label' => 'Видимость'))
            ->add('title',null,array('label' => 'Название страницы'))
            ->add('url',null,array('label' => 'Ссылка страницы'))
            ->add('header',null,array('label' => 'Заголовок'))
            ->add('content',null,array('label' => 'Контент', 'attr' => array(
                    'class' => 'tinymce',
                    'data-width' => '700',
                    'data-theme' => 'advanced' // simple, advanced, bbcode
                ),))
            ->add('menuTop',null,array('label' => 'В меню (верх)', 'required' => false))
            ->add('menuLeft',null,array('label' => 'В меню (лево)', 'required' => false))
            ->add('position',null,array('label' => 'Порядок', 'required' => false))
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title',null,array('label' => 'Название'))
            ->add('enabled',null,array('label' => 'Видимость'))
            ->add('url',null,array('label' => 'Ссылка страницы'))
            ->add('position',null,array('label' => 'Порядок'))
            ->add('_action', 'actions', array(
            'actions' => array(
//                'view' => array(),
                'edit' => array(),
                'delete' => array(),
            )
        ))
        ;
    }
}