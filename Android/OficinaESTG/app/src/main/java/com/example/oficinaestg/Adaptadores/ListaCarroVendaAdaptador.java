package com.example.oficinaestg.Adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.oficinaestg.Modelos.Carro;
import com.example.oficinaestg.R;

import java.util.ArrayList;

public class ListaCarroVendaAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater layoutInflater;
    private ArrayList<Carro> carros;

    public ListaCarroVendaAdaptador(Context context, ArrayList<Carro> carros) {
        this.context = context;
        this.carros = carros;
    }

    @Override
    public int getCount() {
        return carros.size();
    }

    @Override
    public Object getItem(int position) {
        return carros.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(layoutInflater == null){
            layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if(convertView == null){
            convertView = layoutInflater.inflate(R.layout.item_list_carrovenda, null);
        }

        ViewHolderLista viewHolderLista = (ViewHolderLista) convertView.getTag();
        if(viewHolderLista == null){
            viewHolderLista = new ViewHolderLista(convertView);
            convertView.setTag(viewHolderLista);
        }

        viewHolderLista.update(carros.get(position));
        return convertView;
    }

    private class ViewHolderLista{

        private TextView Marca, Modelo, Quilometros, Combustivel, Preco;

        public ViewHolderLista(View convertView){
            Marca = convertView.findViewById(R.id.tv_marca_tx);
            Modelo = convertView.findViewById(R.id.tv_modelo_tx);
            Quilometros = convertView.findViewById(R.id.tv_quilometros_tx);
            Combustivel = convertView.findViewById(R.id.tv_combustivel_tx);
            Preco = convertView.findViewById(R.id.tv_preco_tx);
        }

        public void update(Carro carro){
            Marca.setText(carro.getMarcaCarro());
            Modelo.setText(carro.getModeloCarro());
            Quilometros.setText(""+carro.getQuilometros());
            Combustivel.setText(carro.getCombustivel());
            Preco.setText(""+carro.getPrecoCarro()+"€");
        }

    }
}
