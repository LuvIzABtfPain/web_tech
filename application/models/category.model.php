<?php
class CategoryModel {
    private $error = "";

    public function getcategory (){
        $db = Database::getInstance();
        $query = "select * from categories";
        $result = $db->read($query);
        if (is_array($result)){
            return $result;
        }
        return false;
    }

    public function make_table($cats)
	{

		$result = "";
		if(is_array($cats)){
			foreach ($cats as $cat_row) {
                $edit_args = $cat_row->id.",'".$cat_row->name;
				# code...

				// $color = $cat_row->disabled ? "#ae7c04" : "#5bc0de";
				// $cat_row->disabled = $cat_row->disabled ? "Disabled" : "Enabled";

				// $args = $cat_row->id.",'".$cat_row->disabled."'";
				// $edit_args = $cat_row->id.",'".$cat_row->category."',".$cat_row->parent;
				// $parent = "";

				// foreach ($cats as $cat_row2) {
				// 	if($cat_row->parent == $cat_row2->id){
				// 		$parent = $cat_row2->category;
				// 	}
				// }

 				$result .= "<tr>";

					$result .= '
						<td><a href="basic_table.html#">'.$cat_row->name.'</a></td>
	                    <td>
                        <button onclick="show_edit_category('.$edit_args.',event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                       <button on onclick="delete_row('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
	                  </td>
					';

				$result .= "</tr>";
			}
		}

		return $result;
	}

  public function get_one($id)
	{

		$id = (int)$id;

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where id = '$id' limit 1");
		return $data[0];
	}

  public function get_one_by_name($name)
	{

		$name = addslashes($name);

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where category like :name limit 1",["name"=>$name]);
		return $data[0];
	}


  public function get_all()
	{

		$DB = Database::newInstance();
		return $DB->read("select * from categories order by id desc");

	}


}
