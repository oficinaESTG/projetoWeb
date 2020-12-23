package com.example.oficinaestg.Modelos;

public class Marcacao {
    private int idMarcacoes, fk_idPessoa, fk_idCarro, fk_idResponsavel, valorFinal, horasTrabalho;
    private String tipoMarcacao, dataMarcacao, descricaoMarcacao, estadoMarcacao, descricaoFinal;

    public Marcacao(int idMarcacoes, int fk_idPessoa, int fk_idCarro, int fk_idResponsavel, int valorFinal, int horasTrabalho, String tipoMarcacao,
                    String dataMarcacao, String descricaoMarcacao, String estadoMarcacao, String descricaoFinal) {

        this.idMarcacoes = idMarcacoes;
        this.fk_idPessoa = fk_idPessoa;
        this.fk_idCarro = fk_idCarro;
        this.fk_idResponsavel = fk_idResponsavel;
        this.valorFinal = valorFinal;
        this.horasTrabalho = horasTrabalho;
        this.tipoMarcacao = tipoMarcacao;
        this.dataMarcacao = dataMarcacao;
        this.descricaoMarcacao = descricaoMarcacao;
        this.estadoMarcacao = estadoMarcacao;
        this.descricaoFinal = descricaoFinal;
    }

    public int getIdMarcacoes() {
        return idMarcacoes;
    }

    public void setIdMarcacoes(int idMarcacoes) {
        this.idMarcacoes = idMarcacoes;
    }

    public int getFk_idPessoa() {
        return fk_idPessoa;
    }

    public void setFk_idPessoa(int fk_idPessoa) {
        this.fk_idPessoa = fk_idPessoa;
    }

    public int getFk_idCarro() {
        return fk_idCarro;
    }

    public void setFk_idCarro(int fk_idCarro) {
        this.fk_idCarro = fk_idCarro;
    }

    public int getFk_idResponsavel() {
        return fk_idResponsavel;
    }

    public void setFk_idResponsavel(int fk_idResponsavel) {
        this.fk_idResponsavel = fk_idResponsavel;
    }

    public int getValorFinal() {
        return valorFinal;
    }

    public void setValorFinal(int valorFinal) {
        this.valorFinal = valorFinal;
    }

    public int getHorasTrabalho() {
        return horasTrabalho;
    }

    public void setHorasTrabalho(int horasTrabalho) {
        this.horasTrabalho = horasTrabalho;
    }

    public String getTipoMarcacao() {
        return tipoMarcacao;
    }

    public void setTipoMarcacao(String tipoMarcacao) {
        this.tipoMarcacao = tipoMarcacao;
    }

    public String getDataMarcacao() {
        return dataMarcacao;
    }

    public void setDataMarcacao(String dataMarcacao) {
        this.dataMarcacao = dataMarcacao;
    }

    public String getDescricaoMarcacao() {
        return descricaoMarcacao;
    }

    public void setDescricaoMarcacao(String descricaoMarcacao) {
        this.descricaoMarcacao = descricaoMarcacao;
    }

    public String getEstadoMarcacao() {
        return estadoMarcacao;
    }

    public void setEstadoMarcacao(String estadoMarcacao) {
        this.estadoMarcacao = estadoMarcacao;
    }

    public String getDescricaoFinal() {
        return descricaoFinal;
    }

    public void setDescricaoFinal(String descricaoFinal) {
        this.descricaoFinal = descricaoFinal;
    }
}


