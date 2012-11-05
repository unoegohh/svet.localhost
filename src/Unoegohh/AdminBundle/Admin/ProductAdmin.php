<?php
namespace Unoegohh\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProductAdmin extends Admin
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
            ->add('name',null,array('label' => 'Название товара'))
            ->add('descr_small',null,array('label' => 'Описание (маленькое)'))
            ->add('descr',null,array('label' => 'Описание'))
            ->add('price',null,array('label' => 'Цена'))
            ->add('category','sonata_type_model',array('label' => 'Категория'))
            ->add('position',null,array('label' => 'Порядок', 'required' => false))
            ->add('photos','sonata_type_collection',array('label' => 'Фото', 'required' => false, 'by_reference' => false), array(
                'edit' => 'inline',
                'inline' => 'table'
            ))
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
            ->addIdentifier('name',null,array('label' => 'Название'))
            ->add('enabled',null,array('label' => 'Видимость'))
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