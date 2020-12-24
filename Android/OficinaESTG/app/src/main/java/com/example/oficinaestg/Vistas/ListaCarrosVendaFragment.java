package com.example.oficinaestg.Vistas;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.SearchView;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.example.oficinaestg.Adaptadores.ListaCarroVendaAdaptador;
import com.example.oficinaestg.Listeners.CarroVendaListener;
import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.R;
import com.example.oficinaestg.Singleton.LoginSingleton;
import com.example.oficinaestg.Utils.UserJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class ListaCarrosVendaFragment extends Fragment implements SwipeRefreshLayout.OnRefreshListener, CarroVendaListener {

    private ListView lvCarroLista;
    private ArrayList<Carro> listaCarros;

    private FloatingActionButton fab;

    private SearchView searchView;
    private SwipeRefreshLayout swipeRefreshLayout;

    @Override
    public void onRefresh() {
        LoginSingleton.getInstance(getContext()).getAllCarrosVendaAPI(getContext(), UserJsonParser.isConnectionInternet(getContext()));

        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        setHasOptionsMenu(true);

        View rootView = inflater.inflate(R.layout.fragment_lista_carros, container, false);

        lvCarroLista = rootView.findViewById(R.id.lvListaCarro);

        swipeRefreshLayout = rootView.findViewById(R.id.swipe);
        swipeRefreshLayout.setOnRefreshListener(this);

        LoginSingleton.getInstance(getContext()).setCarrosVendaListener(this);
        LoginSingleton.getInstance(getContext()).getAllCarrosVendaAPI(getContext(),UserJsonParser.isConnectionInternet(getContext()));

        lvCarroLista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Carro temCarro = (Carro) parent.getItemAtPosition(position);

                Intent intent = new Intent(getContext(), DetalhesCarroVendaActivity.class);
                intent.putExtra(DetalhesCarroVendaActivity.DETALHES_CARROVENDA, temCarro.getIdCarro());
                startActivityForResult(intent, 0);
            }
        });

        return rootView;
    }

    @Override
    public void onRefreshListaCarrosVenda(ArrayList<Carro> listaCarros) {

        if(listaCarros != null){
            lvCarroLista.setAdapter(new ListaCarroVendaAdaptador(getContext(), listaCarros));
        }

    }

    @Override
    public void onUpdateListaCarrosVendaBD(Carro livro, int operação) {

    }
}
