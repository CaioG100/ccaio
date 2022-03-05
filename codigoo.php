
    function create($infoaluno)
    {
        try {
            $con = getConnection();
            $stmt = $con->prepare("INSERT INTO aluno(nome, cpf, nmatricula) VALUES (:nome, :cpf)");
            $stmt->bindParam(":nome", $infoaluno->nome);
            $stmt->bindParam(":cpf", $infoaluno->cpf);
            if ($stmt->execute())
                echo "aluno cadastrado";
        } catch (PDOException $error) {
            echo "erro no cadastro. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    function get()
    {
        try {
            $con = getConnection();
            $rs = $con->query("SELECT nome, cpf, nmatricula FROM infoaluno");
            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->cpf . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar as cidades. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }
    function find($nome)
    {
        try {
            $con = getConnection();
            $stmt = $con->prepare("SELECT nome, cpf, sigla_uf FROM cidade WHERE nome LIKE :nome");
            $stmt->bindValue(":nome", "%{$nome}%");
            // $stmt->debugDumpParams();
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->cpf . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar a cidade '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    function update($cpf)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE cidade SET nome = :nome, cpf = :cpf WHERE cod_aluno = :codigo");

            $stmt->bindParam(":codigo", $cidade->codigo);
            $stmt->bindParam(":nome", $cidade->nome);
            $stmt->bindParam(":cpf", $cidade->uf);
            if ($stmt->execute())
                echo "dados atualizados";
        } catch (PDOException $error) {
            echo "Erro. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    function delete($codigo)
    {
        try {
            $con = getConnection();
            $stmt = $con->prepare("DELETE FROM cpf WHERE codigo = ?");
            $stmt->bindParam(1, $codigo);
            if ($stmt->execute())
                echo "aluno deletado";
        } catch (PDOException $error) {
            echo "Erro. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

   