<?php
// Funções para cálculo de formas geométricas
function Retangulo($altura, $base)
{
    $valorRetangulo = 2 * ($altura + $base);
    echo $valorRetangulo;
}

function Quadrado($lado)
{
    $valorQuadrado = 4 * ($lado);
    echo $valorQuadrado;
}

function Paralelogramo($lado1, $lado2)
{
    $valorParalelogramo = 2 * ($lado1 + $lado2);
    echo $valorParalelogramo;
}

function Trapezio($lado1, $lado2, $lado3, $lado4)
{
    $valorTrapezio = $lado1 + $lado2 + $lado3 + $lado4;
    echo $valorTrapezio;
}

// Funções para encontrar o maior e o menor número entre três números
function Maiornum($numer1, $numer2, $numer3)
{
    $maiorNum = max($numer1, $numer2, $numer3);
    echo "O maior número é: " . $maiorNum;
}

function Menornum($numer1, $numer2, $numer3)
{
    $menorNum = min($numer1, $numer2, $numer3);
    echo "O menor número é: " . $menorNum;
}

// Função para criar um vetor aleatório e contar números pares e ímpares
function CriadorVetor()
{
    $numeroUser = $_POST['numeroUser'];
    $numeros = array();
    $numerosImpares = 0;
    $numerosPares = 0;

    for ($x = 0; $x < $numeroUser; $x++) {
        $numeros[$x] = rand(0, 100);
        if ($numeros[$x] % 2 != 0) {
            echo "O número " . $numeros[$x] . " é ímpar <br>";
            $numerosImpares++;
        } else {
            echo "O número " . $numeros[$x] . " é par <br>";
            $numerosPares++;
        }
    }
    echo "Os números ímpares foram: " . $numerosImpares . " e os números pares foram: " . $numerosPares;
}

// Função para misturar dois vetores
function Mistura()
{
    $vetor1 = array();
    $vetor2 = array();
    $vetorMisturado = array();

    for ($i = 0; $i < 20; $i += 2) {
        $vetor1[$i] = rand(1, 100);
        $vetor2[$i] = rand(1, 100);
        $vetorMisturado[$i] = $vetor1[$i];
        $vetorMisturado[$i + 1] = $vetor2[$i];
    }

    echo "Valores do vetor 1: ";
    print_r($vetor1);
    echo "<br> Valores do vetor 2: ";
    print_r($vetor2);
    echo "<br> Vetor misturado: ";
    print_r($vetorMisturado);
}

// Função para converter uma string para maiúsculas e minúsculas
function Maiuscula()
{
    $texto = $_REQUEST['texto'];
    $textoMaiusculo = strtoupper($texto);
    $textoMinuscula = strtolower($texto);
    echo $textoMinuscula . "<br>";
    echo $textoMaiusculo;
}

// Função para substituir uma palavra em uma frase
function Exer7()
{
    $frase = $_POST['texto1'];
    $procurar = $_POST['texto2'];
    $textoSub = $_POST['textoSub'];

    if (strripos($frase, $procurar)) {
        $frase = str_replace($procurar, $textoSub, $frase);
        echo $frase;
    } else {
        echo "Nada para substituir";
    }
}

// Função para gerar uma senha aleatória
function gerarSenha($tamSenha, $primChar = null, $inputBox = array())
{
    $senha = '';
    $alfa_min = range('a', 'z');
    $alfa_MAI = range('A', 'Z');
    $numeros = range(0, 9);
    $chars = range('!', '/');

    $controlador = array();

    if ($primChar != null) {
        $senha .= $primChar;
    }

    if (in_array("M", $inputBox)) {
        $controlador = array_merge($controlador, $alfa_MAI);
    }

    if (in_array("m", $inputBox)) {
        $controlador = array_merge($controlador, $alfa_min);
    }

    if (in_array("char", $inputBox)) {
        $controlador = array_merge($controlador, $chars);
    }

    if (in_array("num", $inputBox)) {
        $controlador = array_merge($controlador, $numeros);
    }

    for ($i = 0; $i < $tamSenha; $i++) {
        $senha .= $controlador[rand(0, sizeof($controlador) - 1)];
    }

    echo $senha;
}
?>

<!-- HTML para formulário de cálculo de formas geométricas -->
<form method="post">
    <h3>Cálculo de Parâmetros Geométricos</h3>
    <h4>Trapezio</h4>
    <input type="number" name="lado1">
    <input type="number" name="lado2">
    <input type="number" name="lado3">
    <input type="number" name="lado4">
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
if (isset($_POST['lado1'], $_POST['lado2'], $_POST['lado3'], $_POST['lado4'])) {
    Trapezio($_POST['lado1'], $_POST['lado2'], $_POST['lado3'], $_POST['lado4']);
}
?>

<!-- HTML para formulário de encontrar maior e menor número -->
<form method="post">
    <h3>Maior e Menor Número</h3>
    <input type="number" name="numer1">
    <input type="number" name="numer2">
    <input type="number" name="numer3">
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
if (isset($_POST['numer1'], $_POST['numer2'], $_POST['numer3'])) {
    Maiornum($_POST['numer1'], $_POST['numer2'], $_POST['numer3']);
    Menornum($_POST['numer1'], $_POST['numer2'], $_POST['numer3']);
}
?>

<!-- HTML para formulário de criação de vetor aleatório -->
<form method="post">
    <h3>Criação de Vetor Aleatório</h3>
    <input type="number" name="numeroUser">
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
if (isset($_POST['numeroUser'])) {
    CriadorVetor();
}
?>

<!-- HTML para formulário de mistura de vetores -->
<form method="post">
    <h3>Mistura de Vetores</h3>
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
Mistura();
?>

<!-- HTML para formulário de conversão de maiúsculas/minúsculas -->
<form method="post">
    <h3>Conversão de Maiúsculas/Minúsculas</h3>
    <input type="text" name="texto">
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
if (isset($_POST['texto'])) {
    Maiuscula();
}
?>

<!-- HTML para formulário de substituição de palavra em frase -->
<form method="post">
    <h3>Substituição de Palavra em Frase</h3>
    <input type="text" name="texto1" maxlength="100" placeholder="Frase">
    <input type="text" name="texto2" maxlength="100" placeholder="Palavra para procurar">
    <input type="text" name="textoSub" maxlength="100" placeholder="Palavra para substituir">
    <input type="submit" value="Calcular" class="btn btn-success">
</form>

<?php
if (isset($_POST['texto1'], $_POST['texto2'], $_POST['textoSub'])) {
    Exer7();
}
?>

<!-- HTML para formulário de geração de senha aleatória -->
<form method="post">
    <h3>Geração de Senha Aleatória</h3>
    <input type="number" name="tamSenha" placeholder="Tamanho da senha">
    <input type="text" name="primChar" maxlength="1" placeholder="Primeiro caractere (opcional)">
    <label><input type="checkbox" name="inputBox[]" value="M"> Maiúsculas</label>
    <label><input type="checkbox" name="inputBox[]" value="m"> Minúsculas</label>
    <label><input type="checkbox" name="inputBox[]" value="char"> Caracteres especiais</label>
    <label><input type="checkbox" name="inputBox[]" value="num"> Números</label>
    <input type="submit" value="Gerar Senha" class="btn btn-success">
</form>

<?php
if (isset($_POST['tamSenha'])) {
    gerarSenha($_POST['tamSenha'], $_POST['primChar'], $_POST['inputBox']);
}
?>
