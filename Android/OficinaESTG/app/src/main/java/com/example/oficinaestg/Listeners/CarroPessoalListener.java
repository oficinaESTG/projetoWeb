package com.example.oficinaestg.Listeners;

import com.example.oficinaestg.Modelos.Carro;

import java.util.ArrayList;

public interface CarroPessoalListener {
    void onRefreshListaCarrosPessoal(ArrayList<Carro> listaCarros);
    void onUpdateListaCarrosPessoalBD(Carro carro, int operação);
}
