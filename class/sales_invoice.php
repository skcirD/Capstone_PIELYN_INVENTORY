<?php
/**
 *Summary Sales, Daily Sales, Monthly Sales, Annually Sales
 *Search By Day, Mont, Year, and Clear search...
 */
class sales_invoice extends config
{
    public function getSummarySales(){
      $con = $this->con();
      $stmt = $con->prepare("SELECT * FROM cart WHERE status='Sold'");

      $stmt->execute();
      $rowC = $stmt->rowCount();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $data) {
        $total = $data['total'] - $data['disc'];

        echo "<tr>
                  <td>$data[cashier]</td>
                  <td>$data[transno]</td>
                  <td>$data[pcode]</td>
                  <td>$data[pdesc]</td>
                  <td>$data[qty]</td>
                  <td>$total</td>
                  <td>$data[sdate]</td>
                  <td>$data[time]</td>
              </tr>";
      }
    }

    public function getTotalSales(){
      $con = $this->con();
      $stmt = $con->prepare("SELECT SUM(total-disc) as total FROM  cart");

      $stmt->execute();
      $rowC = $stmt->rowCount();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


      foreach ($result as $data) {
        echo "<script>
                  document.getElementById('total').innerHTML = $data[total];
             </script>";
      }
    }
}



 ?>
