<?php
include '../../connection.php';


class AppointmentModel extends Database {

    public function __construct() {
        parent::connect();
    }

    public function getAll() {
        $conn = parent::connect();
        $sql = "SELECT * FROM appointments";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $data[]=$row;
        }
        return $data;
    }

    public function getListByCustomerID($cusid){
        $conn = parent::connect();
        $sql = "SELECT * FROM appointments WHERE customer_id='$cusid'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
           $data[] = $row;
        }
        return $data;
    }
    
	public function getUpAppByCusID($cusid){
		$conn = parent::connect();
        $sql = "SELECT * FROM appointments WHERE customer_id='$cusid' AND CURRENT_TIMESTAMP > start_time";
        $result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0)
			return 0;
        while($row = mysqli_fetch_array($result)){
           $data[] = $row;
        }
        return $data;
		
	}
	
	public function getDetailByAppID($id){
        $conn = parent::connect();
        $sql = "select st.name as 'store', se.name as 'service' from appointment_detail ap, services se, stores st WHERE ap.appointment_id='$id' AND ap.service_id = se.id AND st.id = se.store_id ";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
           $data[] = $row;
        }
        return $data;
    }
}