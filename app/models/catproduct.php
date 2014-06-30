<?php
class Catproduct extends AppModel {
    var $name = 'Catproduct';
    var $displayField = 'name';
    var $actsAs = array('Tree');
    //Catproduct quan he 1-n voi Catproduct cha
	var $belongsTo = array(  
        'ParentCat' => array(
            'className' => 'Catproduct',  // className: tên lớp của model có quan hệ với model hiện tại.
            'foreignKey' => 'parent_id'
        )
    );
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điển thông tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
    
    // Catproduct quan he : n-1 voi  Product
	var $hasMany = array(
        'Product' =>
        array('className' => 'Product',                                   //className: tên lớp của model có quan hệ với model hiện tại.
                         'conditions'    => array('Product.status'=>1),   // conditions: phần bổ sung để làm rõ hơn quan hệ bằng cách đặt tên Model phía trước tên trường.
                         'order'         => '',                          // order: thứ tự sắp xếp các dòng được trả về.
                         'limit'         => '',
                         'foreignKey'    => 'catproduct_id',         // foreignKey: tên của khóa ngoại được tìm thấy ở model có quan hệ với model hiện tại.

                         'dependent'     => true,                    //dependent: xác định xem khi xóa dữ liệu từ model hiện tại thì model có quan hệ với model hiện tại có bị xóa hay không.
                         'exclusive'     => false,
                         'finderQuery'   => '',
                         'fields'        => '',                     // fields: Danh sách các trường được trả về khi lấy dữ liệu từ quan hệ được thiết lập, mặc định sẽ trả về tất cả các trường.
                         'offset'        => '',
                         'counterQuery'  => ''
    )
	);
	
}
?>
