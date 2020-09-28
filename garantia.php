 
 
 
 
 
 
 
 
 
 <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <table class="table table-hover table-striped">
				<thead>
					<th width="4%">QNT</th>
					<th width="16%">PECA</th>
					<th width="16%">MODELO</th>
					<th width="16%">COR</th>
					<th width="16%">PREÇO</th>
					<th width="16%">MÃO DE OBRA</th>
					<th width="16%">LUCRO</th>
					<th><center>OPÇÕES</center></th>
				</thead>
				<tbody>';
					# Selecionar clientes no banco de dados...
					$ped = $bd->query("SELECT * FROM pedidos");
					# Verificar se localizou algum cliente...
					if($ped && $ped->num_rows>0){
						while($pd = $ped->fetch_assoc()){
							echo'
							<tr>
								<td>'.utf8_encode($pd["QNT"]).'</td>
								<td align="left">'.utf8_encode($pd["PECA"]).'</td>
								<td align="left">'.utf8_encode($pd["MODELO"]).'</td>
								<td align="left">'.utf8_encode($pd["COR"]).'</td>
								<td align="left">'.utf8_encode($pd["PRECO"]).'</td>
								<td align="left">'.utf8_encode($pd["MAOOBRA"]).'</td>
                                <td align="left">'.utf8_encode($pd["LUCRO"]).'</td>
                                <td align="left">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a title="Alterar" class="btn btn-warning" href="alteraOS.php?codigo='.$pd["COD"].'">✎</a>
                                    <a title="Excluir" class="btn btn-danger" href="excluirOS.php?codigo='.$pd["COD"].'">☠</a>
                                </div>
                            </td>
							</tr>';
						}
                    }
                }
            }
				?>
				</tbody>
			</table>
      </div>
    </div>
  </div>
</div>
</div>
    <div class="container">
		  <hr>

		  <footer>
			<p>&copy; Celular & Cia <?php echo date("Y");?></p>
		  </footer>
		</div> /container


        <?php
        $pedido = $bd->query("select SEMANA from pedido");
        if($pedido && $pedido->num_rows>0){
            while($pd = $pedido->fetch_assoc()){
            echo
    '<div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'
        .utf8_encode($pd["SEMANA"]).'
        </button>
      </h2>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <table class="table table-hover table-striped">
                <thead>
                    <th width="4%">QNT</th>
                    <th width="16%">PECA</th>
                    <th width="16%">MODELO</th>
                    <th width="16%">COR</th>
                    <th width="16%">PREÇO</th>
                    <th width="16%">MÃO DE OBRA</th>
                    <th width="16%">LUCRO</th>
                    <th><center>OPÇÕES</center></th>
                </thead>
        </div>';
             }
        } 
        ?>
        </div>
        </div>
        </div>