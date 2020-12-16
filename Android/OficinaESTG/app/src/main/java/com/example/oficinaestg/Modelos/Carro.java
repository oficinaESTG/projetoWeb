package com.example.oficinaestg.Modelos;

public class Carro {
    private int idCarro, ano, quilometros, fk_idPessoa, precoCarro;
    private String modeloCarro, marcaCarro, matricula, tipoCarro, combustivel;
    private boolean vendido;

    public Carro(int idCarro, int ano, int quilometros, int fk_idPessoa, int precoCarro, String modeloCarro, String marcaCarro, String matricula, String tipoCarro, String combustivel, boolean vendido) {

        this.idCarro = idCarro;
        this.ano = ano;
        this.quilometros = quilometros;
        this.fk_idPessoa = fk_idPessoa;
        this.precoCarro = precoCarro;
        this.modeloCarro = modeloCarro;
        this.marcaCarro = marcaCarro;
        this.matricula = matricula;
        this.tipoCarro = tipoCarro;
        this.combustivel = combustivel;
        this.vendido = vendido;

    }

    public int getIdCarro() {
        return idCarro;
    }

    public void setIdCarro(int idCarro) {
        this.idCarro = idCarro;
    }

    public int getAno() {
        return ano;
    }

    public void setAno(int ano) {
        this.ano = ano;
    }

    public int getQuilometros() {
        return quilometros;
    }

    public void setQuilometros(int quilometros) {
        this.quilometros = quilometros;
    }

    public int getFk_idPessoa() {
        return fk_idPessoa;
    }

    public void setFk_idPessoa(int fk_idPessoa) {
        this.fk_idPessoa = fk_idPessoa;
    }

    public int getPrecoCarro() {
        return precoCarro;
    }

    public void setPrecoCarro(int precoCarro) {
        this.precoCarro = precoCarro;
    }

    public String getModeloCarro() {
        return modeloCarro;
    }

    public void setModeloCarro(String modeloCarro) {
        this.modeloCarro = modeloCarro;
    }

    public String getMarcaCarro() {
        return marcaCarro;
    }

    public void setMarcaCarro(String marcaCarro) {
        this.marcaCarro = marcaCarro;
    }

    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    public String getTipoCarro() {
        return tipoCarro;
    }

    public void setTipoCarro(String tipoCarro) {
        this.tipoCarro = tipoCarro;
    }

    public String getCombustivel() {
        return combustivel;
    }

    public void setCombustivel(String combustivel) {
        this.combustivel = combustivel;
    }

    public boolean isVendido() {
        return vendido;
    }

    public void setVendido(boolean vendido) {
        this.vendido = vendido;

    }
}
