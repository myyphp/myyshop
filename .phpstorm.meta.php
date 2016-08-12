<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Adv' instanceof Think\Model\AdvModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'View' instanceof Think\Model\ViewModel,
			'Category' instanceof Admin\Model\CategoryModel,
			'Privilege' instanceof Admin\Model\PrivilegeModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Role' instanceof Admin\Model\RoleModel,
			'Admin' instanceof Admin\Model\AdminModel,
			'Goods' instanceof Admin\Model\GoodsModel,
			'Merge' instanceof Think\Model\MergeModel,
		],
	];
}