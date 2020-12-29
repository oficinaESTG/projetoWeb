package com.example.oficinaestg.Vistas;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.SearchView;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.oficinaestg.Adaptadores.ListaMarcacaoAdaptador;
import com.example.oficinaestg.Listeners.MarcacoesListener;
import com.example.oficinaestg.Modelos.Marcacao;
import com.example.oficinaestg.Modelos.User;
import com.example.oficinaestg.Modelos.UserDBHelp;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaMarcacoesFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, MarcacoesListener {

    private ListView lvListaMarcacoes;
    private ArrayList<Marcacao> listamarcacoes;
    private UserDBHelp userlogado1;
    private User userlogado;



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

        fab = rootView.findViewById(R.id.fabaddMarcacao);




        lvListaMarcacoes.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long l) {
                Marcacao temMarcacao = (Marcacao) parent.getItemAtPosition(position);

                Intent intent = new Intent(getContext(), DetalhesMarcacaoActivity.class);
                intent.putExtra(DetalhesMarcacaoActivity.DETALHES_MARCACAO, temMarcacao.getIdMarcacoes());
                startActivityForResult(intent, 0);
            }
        });

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(getContext(), DetalhesMarcacaoActivity.class);
                intent.putExtra(DetalhesMarcacaoActivity.DETALHES_USER, userlogado.getId());
                System.out.println("--> "+userlogado.getId());
                startActivityForResult(intent, 0);
            }
        });

        return rootView;
    }


    @Override
    public void onRefresh() {
        LoginSingleton.getInstance(getContext()).getAllMarcacoesUserLoggadoAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));


        boolean net = UserJsonParser.isConnectionInternet(getContext());
        if (!net){
            fab.setVisibility(View.INVISIBLE);
        }

        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void onRefreshListaMarcacao(ArrayList<Marcacao> listamarcacoes, User user) {
        if(listamarcacoes != null){
            lvListaMarcacoes.setAdapter(new ListaMarcacaoAdaptador(getContext(), listamarcacoes));
            userlogado = user;
        }
    }

    @Override
    public void onActions() {

    }
}