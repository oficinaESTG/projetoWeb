package com.example.oficinaestg.Vistas;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.SearchView;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.oficinaestg.Adaptadores.ListaMarcacaoAdaptador;
import com.example.oficinaestg.Listeners.MarcacoesListener;
import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaMarcacoesFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, MarcacoesListener {

    private ListView lvListaMarcacoes;
    private ArrayList<Marcacao> listamarcacoes;

    private FloatingActionButton fab;

    private SearchView searchView;
    private SwipeRefreshLayout swipeRefreshLayout;

    public ListaMarcacoesFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        setHasOptionsMenu(true);

        View rootView = inflater.inflate(R.layout.fragment_lista_marcacoes, container, false);

        lvListaMarcacoes = rootView.findViewById(R.id.lvListaMarcacao);

        swipeRefreshLayout = rootView.findViewById(R.id.swipe);
        swipeRefreshLayout.setOnRefreshListener(this);

        LoginSingleton.getInstance(getContext()).setMarcacoesListener(this);
        LoginSingleton.getInstance(getContext()).getAllMarcacoesUserLoggadoAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));

        return rootView;
    }


    @Override
    public void onRefresh() {
        LoginSingleton.getInstance(getContext()).getAllMarcacoesUserLoggadoAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));

        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaMarcacao(ArrayList<Marcacao> listamarcacoes) {
        if(listamarcacoes != null){
            lvListaMarcacoes.setAdapter(new ListaMarcacaoAdaptador(getContext(), listamarcacoes));
        }
    }
}