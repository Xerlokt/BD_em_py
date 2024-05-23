import mysql.connector
 
# Modelo para livro
class Livro:
    def __init__(self, id, autor, titulo, ano, tombo):
        self.id = id
        self.autor = autor
        self.titulo = titulo
        self.ano = ano
        self.tombo = tombo
 
# Modelo para usuário
class Usuario:
    def __init__(self, id, identidade, nome):
        self.id = id
        self.identidade = identidade
        self.nome = nome
 
# Modelo para empréstimo
class Emprestimo:
    def __init__(self, id, usuario_id, livro_id, data_emprestimo, data_devolucao):
        self.id = id
        self.usuario_id = usuario_id
        self.livro_id = livro_id
        self.data_emprestimo = data_emprestimo
        self.data_devolucao = data_devolucao
 
# DAO para livro
class LivroDAO:
    def __init__(self):
        self.connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='biblioteca'
        )
        self.cursor = self.connection.cursor()
 
    def obter_livros(self, id=None):  # Adicionado parâmetro opcional id
        if id:
            self.cursor.execute("SELECT id, autor, titulo, ano, tombo FROM livros WHERE id = %s", (id,))
        else:
            self.cursor.execute("SELECT id, autor, titulo, ano, tombo FROM livros")
        livros = []
        for livro_data in self.cursor.fetchall():
            livro_id, autor, titulo, ano, tombo = livro_data
            livro = Livro(livro_id, autor, titulo, ano, tombo)
            livros.append(livro)
        return livros
   
    def remover_livro(self, livro_id):
        self.cursor.execute("DELETE FROM livros WHERE id = %s", (livro_id,))
        self.connection.commit()
 
# DAO para usuário
class UsuarioDAO:
    def __init__(self):
        self.connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='biblioteca'
        )
        self.cursor = self.connection.cursor()
 
    def obter_usuario_por_id(self, usuario_id):
        self.cursor.execute("SELECT id, identidade, nome FROM usuarios WHERE id = %s", (usuario_id,))
        usuario_data = self.cursor.fetchone()
        if usuario_data:
            usuario_id, identidade, nome = usuario_data
            usuario = Usuario(usuario_id, identidade, nome)
            return usuario
        else:
            return None
       
    def obter_usuarios(self):
        self.cursor.execute("SELECT id, identidade, nome FROM usuarios")
        usuarios = []
        for usuario_data in self.cursor.fetchall():
            usuario_id, identidade, nome = usuario_data
            usuario = Usuario(usuario_id, identidade, nome)
            usuarios.append(usuario)
        return usuarios
 
# DAO para empréstimo
class EmprestimoDAO:
    def __init__(self):
        self.connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='biblioteca'
        )
        self.cursor = self.connection.cursor()
 
    def obter_emprestimos(self):
        self.cursor.execute("SELECT id, usuario_id, livro_id, data_emprestimo, data_devolucao FROM emprestimos")
        emprestimos = []
        for emprestimo_data in self.cursor.fetchall():
            emprestimo_id, usuario_id, livro_id, data_emprestimo, data_devolucao = emprestimo_data
            emprestimo = Emprestimo(emprestimo_id, usuario_id, livro_id, data_emprestimo, data_devolucao)
            emprestimos.append(emprestimo)
        return emprestimos
 
# Visualização (view)
class EmprestimoView:
    def mostrar_detalhes(self, emprestimo, livro, usuario):
        print("Detalhes do Empréstimo:")
        print(f"ID: {emprestimo.id}")
        print(f"Livro: {livro.titulo}")
        print(f"Usuário: {usuario.nome}")
        print(f"Data de Empréstimo: {emprestimo.data_emprestimo}")
        print(f"Data de Devolução: {emprestimo.data_devolucao}")
 
# Controlador (controller)
class EmprestimoController:
    def __init__(self, emprestimo_dao, livro_dao, usuario_dao, view):
        self.emprestimo_dao = emprestimo_dao
        self.livro_dao = livro_dao
        self.usuario_dao = usuario_dao
        self.view = view
 
    def obter_e_mostrar_detalhes(self):
        emprestimos = self.emprestimo_dao.obter_emprestimos()
        for emprestimo in emprestimos:
            livro_id = emprestimo.livro_id
            livro = self.livro_dao.obter_livros(livro_id)[0]  # Obter o primeiro livro da lista
            usuario = self.usuario_dao.obter_usuario_por_id(emprestimo.usuario_id)
            self.view.mostrar_detalhes(emprestimo, livro, usuario)
 
# Função para exibir opções
def exibir_opcoes():
    print("Escolha uma opção:")
    print("1 - Obter livros")
    print("2 - Obter usuários")
    print("3 - Obter empréstimos")
    print("4 - Remover Livro")
    print("0 - Sair")
 
# Uso do MVC
# Criar instâncias dos DAOs
livro_dao = LivroDAO()
usuario_dao = UsuarioDAO()
emprestimo_dao = EmprestimoDAO()
 
# Criar instância da visualização
emprestimo_view = EmprestimoView()
 
# Criar instância do controlador e passar os DAOs e a visualização
emprestimo_controller = EmprestimoController(emprestimo_dao, livro_dao, usuario_dao, emprestimo_view)
 
# Loop para exibir opções e executar ação escolhida pelo usuário
while True:
    exibir_opcoes()
    opcao = input("Opção: ")
    if opcao == "1":
        livros = livro_dao.obter_livros()
        for livro in livros:
            print(f"ID: {livro.id}, Título: {livro.titulo}")
    elif opcao == "2":
        usuarios = usuario_dao.obter_usuarios()
        for usuario in usuarios:
            print(f"ID: {usuario.id}, Nome: {usuario.nome}")
    elif opcao == "3":
        emprestimo_controller.obter_e_mostrar_detalhes()
    elif opcao == "4":
        livro_id = int(input("Digite o ID do livro a ser removido: "))
        livro_dao.remover_livro(livro_id)
    elif opcao == "0":
        print("Saindo...")
        break
    else:
        print("Opção inválida. Tente novamente.")