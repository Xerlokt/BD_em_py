import mysql.connector


# Conectar ao servidor MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="biblioteca"
)
cursor = conn.cursor()

# Inserir dados na tabela 'livros'
cursor.execute("INSERT INTO livros (autor, titulo, ano, tombo) VALUES (%s, %s, %s, %s)", ("Autor1", "Livro1", 2021, "T001"))
cursor.execute("INSERT INTO livros (autor, titulo, ano, tombo) VALUES (%s, %s, %s, %s)", ("Autor2", "Livro2", 2022, "T002"))

# Inserir dados na tabela 'usuarios'
cursor.execute("INSERT INTO usuarios (identidade, nome) VALUES (%s, %s)", ("123456789", "Usuario1"))
cursor.execute("INSERT INTO usuarios (identidade, nome) VALUES (%s, %s)", ("987654321", "Usuario2"))

# Inserir dados na tabela 'emprestimos'

cursor.execute("INSERT INTO emprestimos (usuario_id, data_emprestimo, data_devolucao, livro_id) VALUES (%s, %s, %s, %s)", (5, "2024-04-01", "2024-04-15", 9))
cursor.execute("INSERT INTO emprestimos (usuario_id, data_emprestimo, data_devolucao, livro_id) VALUES (%s, %s, %s, %s)", (6, "2024-04-05", "2024-04-20", 10))