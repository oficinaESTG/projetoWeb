package com.example.oficinaestg.Listeners;

import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.Modelos.User;

import java.util.ArrayList;

public interface MarcacoesListener {
    void onRefreshListaMarcacao(ArrayList<Marcacao> listaMarcacao, User user);
    void onActions();
}
