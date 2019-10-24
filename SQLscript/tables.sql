CREATE TABLE IF NOT EXISTS permissao (
	id SMALLSERIAL,
	nome VARCHAR NOT NULL,

	CONSTRAINT permissao_pk PRIMARY KEY (id) 
);

CREATE TABLE IF NOT EXISTS usuario (
	id SERIAL,
	nome VARCHAR(45) NOT NULL UNIQUE,
	email VARCHAR NOT NULL UNIQUE,
	senha VARCHAR NOT NULL,
	data_criacao DATE NOT NULL,
	permissao_id INTEGER NOT NULL,

	CONSTRAINT usuario_pk PRIMARY KEY (id),
	CONSTRAINT usuario_permissao_fk FOREIGN KEY (permissao_id)
		REFERENCES permissao (id)
);

CREATE TABLE IF NOT EXISTS disciplina (
	id SERIAL,
	nome VARCHAR(45) NOT NULL UNIQUE,

	CONSTRAINT disciplina_pk PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS notificacao (
	usuario_id INTEGER,
	disciplina_id INTEGER,

	CONSTRAINT notificacao_pk PRIMARY KEY(usuario_id, disciplina_id),
	CONSTRAINT notificacao_usuario_fk FOREIGN KEY(usuario_id)
		REFERENCES usuario(id) ON DELETE CASCADE,
	CONSTRAINT notificacao_disciplina_fk FOREIGN KEY(disciplina_id)
		REFERENCES disciplina(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS assunto (
	id SERIAL,
	nome VARCHAR(45) NOT NULL,
	disciplina_id INTEGER NOT NULL,

	CONSTRAINT assunto_pk PRIMARY KEY (id),
	CONSTRAINT assunto_disciplina_fk FOREIGN KEY(disciplina_id)
		REFERENCES disciplina(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS postagem (
	id SERIAL,
	tipo VARCHAR(45) NOT NULL,
	link VARCHAR NOT NULL,
	titulo VARCHAR(45) NOT NULL,
	descricao VARCHAR,
	votos INTEGER DEFAULT(0),
	data_criacao TIMESTAMP NOT NULL,
	usuario_id INTEGER,
	assunto_id INTEGER NOT NULL,

	CONSTRAINT postagem_pk PRIMARY KEY (id),
	CONSTRAINT postagem_usuario_fk FOREIGN KEY(usuario_id)
		REFERENCES usuario(id),
	CONSTRAINT postagem_assunto_fk FOREIGN KEY(assunto_id)
		REFERENCES assunto(id)
);

CREATE TABLE IF NOT EXISTS lista (
	id SERIAL,
	nome VARCHAR(45) NOT NULL,
	descricao VARCHAR,
	data_criacao TIMESTAMP NOT NULL,
	votos INTEGER DEFAULT(0),
	usuario_id INTEGER NOT NULL,

	CONSTRAINT lista_pk PRIMARY KEY(id),
	CONSTRAINT lista_usuario_fk FOREIGN KEY (usuario_id)
		REFERENCES usuario(id)
);

CREATE TABLE IF NOT EXISTS lista_conteudo (
	lista_id INTEGER,
	postagem_id INTEGER,

	CONSTRAINT lista_conteudo_pk PRIMARY KEY(lista_id, postagem_id),
	CONSTRAINT lista_conteudo_lista_fk FOREIGN KEY(lista_id)
		REFERENCES lista(id),
	CONSTRAINT lista_conteudo_postagem_fk FOREIGN KEY(postagem_id)
		REFERENCES postagem(id)
);