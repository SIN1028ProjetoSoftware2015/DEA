<?php

$_POST['bombeando'] = ( isset($_POST['bombeando']) ) ? 'checked' : null;
$_POST['abandonado'] = ( isset($_POST['abandonado']) ) ? 'checked' : null;
$_POST['nutil'] = ( isset($_POST['nutil']) ) ? 'checked' : null;
$_POST['ninstal'] = ( isset($_POST['ninstal']) ) ? 'checked' : null;

$_POST['fechado'] = ( isset($_POST['fechado']) ) ? 'checked' : null;
$_POST['precario'] = ( isset($_POST['precario']) ) ? 'checked' : null;
$_POST['obstruido'] = ( isset($_POST['obstruido']) ) ? 'checked' : null;
$_POST['colmatado'] = ( isset($_POST['colmatado']) ) ? 'checked' : null;

$_POST['parado'] = ( isset($_POST['parado']) ) ? 'checked' : null;
$_POST['seco'] = ( isset($_POST['seco']) ) ? 'checked' : null;
$_POST['equipado'] = ( isset($_POST['equipado']) ) ? 'checked' : null;
$_POST['indisp'] = ( isset($_POST['indisp']) ) ? 'checked' : null;

$_POST['humano'] = ( isset($_POST['humano']) ) ? 'checked' : null;
$_POST['animais'] = ( isset($_POST['animais']) ) ? 'checked' : null;
$_POST['irrigacao'] = ( isset($_POST['irrigacao']) ) ? 'checked' : null;
$_POST['recreacao'] = ( isset($_POST['recreacao']) ) ? 'checked' : null;

$_POST['todos'] = ( isset($_POST['todos']) ) ? 'checked' : null;
$_POST['data'] = ( isset($_POST['data']) ) ? $_POST['data'] : null;

if ($_POST['humano']=='checked' || $_POST['animais'] == 'checked' ||
        $_POST['irrigacao']== 'checked' || $_POST['recreacao'] == 'checked'){
    $contand = 0;
    
    
    if ($_POST['bombeando'] == 'checked'){
        $contand ++;
    }
    if ($_POST['abandonado'] == 'checked'){
        $contand ++;
    }
    if ($_POST['nutil'] == 'checked'){
        $contand ++;
    }
    if ($_POST['ninstal'] == 'checked'){
        $contand ++;
    }
    if ($_POST['fechado'] == 'checked'){
        $contand ++;
    }
    if ($_POST['precario'] == 'checked'){
        $contand ++;
    }
    if ($_POST['obstruido'] == 'checked'){
        $contand ++;
    }
    if ($_POST['colmatado'] == 'checked'){
        $contand ++;
    }
    if ($_POST['parado'] == 'checked'){
        $contand ++;
    }
    if ($_POST['seco'] == 'checked'){
        $contand ++;
    }
    if ($_POST['equipado'] == 'checked'){
        $contand ++;
    }
    if ($_POST['indisp'] == 'checked'){
        $contand ++;
    }
    
    
}

if ($_POST['bombeando'] == 'checked' || $_POST['abandonado']== 'checked' || $_POST['nutil'] == 'checked' || $_POST['ninstal']=='checked' ||
        $_POST['fechado'] == 'checked' || $_POST['precario']=='checked' || $_POST['obstruido']=='checked' || $_POST['colmatado']=='checked' ||
        $_POST['parado'] == 'checked' || $_POST['seco']=='checked' || $_POST['equipado']=='checked' || $_POST['indisp']=='checked' ||
        $_POST['humano'] == 'checked' || $_POST['animais']=='checked' || $_POST['irrigacao']=='checked' || $_POST['recreacao']=='checked'){
        if ($_POST['todos']=='checked'){
            $_POST['todos']='checked';
        }else{
            $_POST['todos']=null;
        }
           
}

if ($_POST['bombeando'] == null && $_POST['abandonado']== null && $_POST['nutil'] == null && $_POST['ninstal']==null &&
        $_POST['fechado'] == null && $_POST['precario']==null && $_POST['obstruido']==null && $_POST['colmatado']==null &&
        $_POST['parado'] == null && $_POST['seco']==null && $_POST['equipado']==null && $_POST['indisp']==null &&
        $_POST['humano'] == null && $_POST['animais']==null && $_POST['irrigacao']==null && $_POST['recreacao']==null){
    
            $_POST['todos']='checked';
}



if($_POST['data'] != null){
    $dataCons = " and q.data <= '".$_POST['data']."'";
    $dataConsWhere = " where q.data <= '".$_POST['data']."'";
}else{
    $dataCons = null;
    $dataConsWhere = null;
}




require_once 'conexao.php'; 
$conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD); 
    
    
    $cordenada = array();
    $coordAux = array();
    
    if ($_POST['todos'] == 'checked'){
        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,
        
                    q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                    q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                    q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                    c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                from poco as p
                    left join  qualidade_agua as q
                            on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                    left join  capacidade_poco as c
                    on p.utme = c.poco_utme and p.utmn = c.poco_utmn".$dataConsWhere;
        
                    if ($result = mysqli_query($conexao->conn, $query)) {
                
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                        $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                        $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                        $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                        $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                        $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                        }
                        $coordAux = $coordAux+$cordenada;
                        mysqli_free_result($result);
                    }
    }else{
        if ($_POST['humano']==null && $_POST['animais'] == null &&
        $_POST['irrigacao']== null && $_POST['recreacao'] == null){
            if ($_POST['bombeando'] == 'checked'){
            $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,
        
                    q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                    q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                    q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                    c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                from poco as p
                    left join  qualidade_agua as q
                            on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                    left join  capacidade_poco as c
                    on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                    where p.situacao = 'Bombeando'".$dataCons;
                    
                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['abandonado'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Abandonado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['nutil'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Não utilizável'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['ninstal'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Não Instalado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['fechado'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Fechado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['precario'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Precário'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['obstruido'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Obstruído'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['colmatado'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Colmatado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['parado'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Parado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['seco'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Seco'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['equipado'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = 'Equipado'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
            if ($_POST['indisp'] == 'checked'){
                $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                        where p.situacao = '0'".$dataCons;

                if ($result = mysqli_query($conexao->conn, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                    $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                    $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                    $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                    $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                    $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                    }
                    $coordAux = $coordAux+$cordenada;
                    mysqli_free_result($result);
                }
            }
        }else{
        
            if ($_POST['humano'] == 'checked'){
                if ($contand == 0){
                    $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                            and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                        and q.solidos_tot_dissolvidos <= 1000".$dataCons;

                    if ($result = mysqli_query($conexao->conn, $query)) {
                        $coordAux = array();
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                        $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                        $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                        $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                        $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                        $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                        }
                        $coordAux = $coordAux+$cordenada;
                        mysqli_free_result($result);
                    }
                }

                if ($contand >= 1){
                    if ($_POST['bombeando']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                            and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                        and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Bombeando'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['abandonado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Abandonado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                    if ($_POST['nutil']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Não utilizável'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['ninstal']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Não instalado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['fechado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Fechado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['precario']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Precário'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['obstruido']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Obstruído'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['colmatado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Colmatado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['parado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Parado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['seco']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Seco'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['equipado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = 'Equipado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['indisp']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 200 and q.cloretos <= 250 and q.fluor <= 1.5
                                                and q.ph >= 6 and q.ph <= 9.5 and q.sulfatos <= 250 and q.dureza <= 500
                            and q.solidos_tot_dissolvidos <= 1000 and p.situacao = '0'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                }

            }
            if ($_POST['animais'] == 'checked'){
                if ($contand == 0){
                    $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.fluor <= 2 and q.sulfatos <= 1000 ".$dataCons;

                    if ($result = mysqli_query($conexao->conn, $query)) {
                        $coordAux = array();
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                        $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                        $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                        $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                        $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                        $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                        }
                        $coordAux = $coordAux+$cordenada;
                        mysqli_free_result($result);
                    }
                }

                if ($contand >= 1){
                    if ($_POST['bombeando']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.fluor <= 2 and q.sulfatos <= 1000  and p.situacao = 'Bombeando'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['abandonado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Abandonado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                    if ($_POST['nutil']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Não utilizável'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['ninstal']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Não instalado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['fechado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Fechado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['precario']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Precário'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['obstruido']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Obstruído'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['colmatado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Colmatado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['parado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Parado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['seco']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Seco'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['equipado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = 'Equipado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['indisp']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.fluor <= 2 and q.sulfatos <= 1000 and p.situacao = '0'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                }
            }
            
            
            if ($_POST['irrigacao'] == 'checked'){
                if ($contand == 0){
                    $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1".$dataCons;

                    if ($result = mysqli_query($conexao->conn, $query)) {
                        $coordAux = array();
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                        $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                        $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                        $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                        $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                        $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                        }
                        $coordAux = $coordAux+$cordenada;
                        mysqli_free_result($result);
                    }
                }

                if ($contand >= 1){
                    if ($_POST['bombeando']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1  and p.situacao = 'Bombeando'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['abandonado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Abandonado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                    if ($_POST['nutil']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Não utilizável'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['ninstal']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Não instalado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['fechado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Fechado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['precario']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Precário'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['obstruido']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Obstruído'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['colmatado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Colmatado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['parado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Parado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['seco']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Seco'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['equipado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = 'Equipado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['indisp']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.cloretos >= 100 and q.cloretos <= 700 and q.fluor <= 1 and p.situacao = '0'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                }
                
            }
            
            
            if ($_POST['recreacao'] == 'checked'){
                if ($contand == 0){
                    $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400".$dataCons;

                    if ($result = mysqli_query($conexao->conn, $query)) {
                        $coordAux = array();
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                        $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                        $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                        $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                        $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                        $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                        }
                        $coordAux = $coordAux+$cordenada;
                        mysqli_free_result($result);
                    }
                }

                if ($contand >= 1){
                    if ($_POST['bombeando']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                        q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                        q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                        q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                        c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                    from poco as p
                        left join  qualidade_agua as q
                                on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                        left join  capacidade_poco as c
                        on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                    where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400  and p.situacao = 'Bombeando'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['abandonado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Abandonado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    
                    if ($_POST['nutil']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Não utilizável'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['ninstal']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Não instalado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['fechado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Fechado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['precario']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Precário'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['obstruido']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Obstruído'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['colmatado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Colmatado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['parado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Parado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['seco']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Seco'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['equipado']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = 'Equipado'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                    if ($_POST['indisp']){
                        $query = "select p.utme, p.utmn, p.latitudese, p.longitudes, p.situacao, p.profundidade, p.uso_agua,

                            q.alcalinidade, q.bicarbonatos, q.calcio, q.carbonatos, q.cloretos, q.condutividade_eletrica,
                            q.data, q.dureza, q.fluor, q.magnesio, q.ph, q.potassio, q.responsavel, q.sodio, 
                            q.solidos_tot_dissolvidos, q.sulfatos, q.temperatura,

                            c.cap_especifica, c.niveldinamico, c.nivelestatico, c.vazao_estabilizacao

                        from poco as p
                            left join  qualidade_agua as q
                                    on p.utme = q.poco_utme and p.utmn = q.poco_utmn
                            left join  capacidade_poco as c
                            on p.utme = c.poco_utme and p.utmn = c.poco_utmn
                                        where q.sodio <= 300 and q.cloretos <= 400 and q.sulfatos <= 400 and p.situacao = '0'".$dataCons;

                        if ($result = mysqli_query($conexao->conn, $query)) {
                            $coordAux = array();
                            /* fetch associative array */
                            while ($row = mysqli_fetch_assoc($result)) {
                                array_push($cordenada, $row["latitudese"], $row["longitudes"], $row["situacao"], $row["profundidade"],
                                            $row["uso_agua"], $row["alcalinidade"], $row["bicarbonatos"], $row["calcio"],
                                            $row["carbonatos"], $row["cloretos"], $row["condutividade_eletrica"],$row["dureza"], 
                                            $row["fluor"], $row["magnesio"], $row["ph"], $row["potassio"], $row["sodio"], 
                                            $row["solidos_tot_dissolvidos"], $row["sulfatos"], $row["temperatura"], $row["cap_especifica"], 
                                            $row["niveldinamico"], $row["nivelestatico"], $row["vazao_estabilizacao"]);
                            }
                            $coordAux = $coordAux+$cordenada;
                            mysqli_free_result($result);
                        }
                    }
                }
            }
        }
    }  
   
    $string_array = implode("|", $coordAux);
    /* close connection */
    mysqli_close($conexao->conn);  
?>