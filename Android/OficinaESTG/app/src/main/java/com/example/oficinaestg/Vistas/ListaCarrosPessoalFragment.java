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

import com.example.oficinaestg.Adaptadores.ListaCarroPessoalAdaptador;
import com.example.oficinaestg.Adaptadores.ListaCarroVendaAdaptador;
import com.example.oficinaestg.Listeners.CarroPessoalListener;
import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaCarrosPessoalFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, CarroPessoalListener {

    private ListView lvCarroPessoalLista;
    private ArrayList<Carro> listaCarros;

    private FloatingActionButton fab;

    private SearchView searchView;
    private SwipeRefreshLayout swipeRefreshLayout;


    @Override
    public void onRefresh() {
        LoginSingleton.getInstance(getContext()).getAllCarrosPessoalAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));

        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        setHasOptionsMenu(true);

        View rootView = inflater.inflate(R.layout.fragment_lista_carrospessoal, container, false);

        lvCarroPessoalLista = rootView.findViewById(R.id.lvListaCarroPessoal);

        swipeRefreshLayout = rootView.findViewById(R.id.swipe);
        swipeRefreshLayout.setOnRefreshListener(this);

        LoginSingleton.getInstance(getContext()).setCarrosPessoalListener(this);
        LoginSingleton.getInstance(getContext()).getAllCarrosPessoalAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));

        fab = rootView.findViewById(R.id.fabAdicionarCarro);

        lvCarroPessoalLista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Carro temCarro = (Carro) parent.getItemAtPosition(position);

                Intent intent = new Intent(getContext(), DetalhesCarroPessoalActivity.class);
                intent.putExtra(DetalhesCarroPessoalActivity.DETALHES_CARROPESSOAL, temCarro.getIdCarro());
                startActivityForResult(intent, 0);
            }
        });

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getContext(), DetalhesCarroPessoalActivity.class);
                startActivityForResult(intent, 0);
            }
        });


        return rootView;
    }

    @Override
    public void onRefreshListaCarrosPessoal(ArrayList<Carro> listaCarros) {
        if(listaCarros != null){
            lvCarroPessoalLista.setAdapter(new ListaCarroPessoalAdaptador(getContext(), listaCarros));
        }
    }

    @Override
    public void onUpdateListaCarrosPessoalBD(Carro carro, int operação) {

    }
}
