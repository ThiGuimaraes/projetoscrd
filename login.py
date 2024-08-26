import requests

# URL do endpoint de login
login_url = 'http://localhost/myproject/public/login.php'

# Dados de login
data = {
    'nome': 'admin',  # Nome de usuário
    'senha': 'admin'  # Senha
}

# Realiza a solicitação POST
response = requests.post(login_url, data=data)

# Verifica se o login foi bem-sucedido
if response.url.endswith('index.php'):
    print('Login bem-sucedido!')
else:
    print('Falha no login.')
