package com.example.oficinaestg.Listeners;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.Modelos.User;

import java.util.ArrayList;

public interface CarroVendaListener {
    void onRefreshListaCarrosVenda(ArrayList<Carro> listaCarros);
    void onUpdateListaCarrosVendaBD(Carro livro, int operação);

}
