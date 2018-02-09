<?php
require_once 'application/controller/Controller.php';

$controller = new Controller('application');

if(isset($_GET['incoming']))
{
        $date = date("Y-m-d");
        
        $datas = $controller->getcustomdata("select * from posts where dateReported = '$date' and status = 'pending' and isTrashed = 0 order by id desc");
        
        $count = 0;
        foreach($datas as $data)
        {
            $id = $data->id;
            $user = $data->user;
            $isread = $data->isRead;
            
            $datetime = $data->date;
            $datet = $data->dateReported;

            $time = $datet;
            if($date == $date){
                $time = 'Today';
            }
            
            $split_date = explode(' ', $datetime);
            
            $newsdate = $split_date[0];
            //echo $date;
            
            $count++;
            $time_elapsed = $controller->time_elapsed_string($datetime, false);
            
            $sender = '';
            $get_sender = $controller->getindividual("users", "id", $user);
            
            foreach($get_sender as $send)
            {
                $sender = $send->fname.' '.$send->lname;
            }
			
			$style = '';
			$attrib = '';
			if($isread == 0){
				$style = 'class="isbold"';
				$attrib = '&isread';
				
			}
        ?>
        <tr>
        	<td><input type="checkbox" class="table_records flat" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->title;?>"></td>
          <td><?php echo $count;?></td>
          <td><a <?php echo $style;?> href="?detail=<?php echo $id.$attrib;?>"><?php echo $data->title;?></a></td>
          <td><?php echo $sender;?></td>
          <td><?php echo $time;?></td>
          <!--<td><?php echo $data->status;?></td>-->
        </tr>
        <?php
            
        }
        
}