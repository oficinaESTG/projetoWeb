package com.example.oficinaestg.Modelos;

public class Pessoa {

    int idPessoa, nif, fk_IdUser;
    String nome, morada, tipoPessoa;
    String dataNascimento;

    public Pessoa(int idPessoa, int nif, int fk_IdUser, String nome, String morada, String tipoPessoa, String dataNascimento) {
        this.idPessoa = idPessoa;
        this.nif = nif;
        this.fk_IdUser = fk_IdUser;
        this.nome = nome;
        this.morada = morada;
        this.tipoPessoa = tipoPessoa;
        this.dataNascimento = dataNascimento;
    }

    public int getIdPessoa() {
        return idPessoa;
    }

    public void setIdPessoa(int idPessoa) {
        this.idPessoa = idPessoa;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public int getFk_IdUser() {
        return fk_IdUser;
    }

    public void setFk_IdUser(int fk_IdUser) {
        this.fk_IdUser = fk_IdUser;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getMorada() {
        return morada;
    }

    public void setMorada(String morada) {
        this.morada = morada;
    }

    public String getTipoPessoa() {
        return tipoPessoa;
    }

    public void setTipoPessoa(String tipoPessoa) {
        this.tipoPessoa = tipoPessoa;
    }

    public String getDataNascimento() {
        return dataNascimento;
    }

    public void setDataNascimento(String dataNascimento) {
        this.dataNascimento = dataNascimento;
    }
}
