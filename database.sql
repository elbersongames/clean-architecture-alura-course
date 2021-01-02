CREATE TABLE students (
    cpf TEXT PRIMARY KEY,
    name TEXT,
    email TEXT
);

CREATE TABLE phones (
    ddd TEXT,
    number TEXT,
    cpf_student TEXT,
    PRIMARY KEY (ddd, number),
    FOREIGN KEY (cpf_student) REFERENCES students(cpf)
);

CREATE TABLE indications (
    cpf_indicator TEXT,
    cpf_indicated TEXT,
    PRIMARY KEY (cpf_indicator, cpf_indicated),
    FOREIGN KEY (cpf_indicator) REFERENCES students(cpf),
    FOREIGN KEY (cpf_indicated) REFERENCES students(cpf)
);
