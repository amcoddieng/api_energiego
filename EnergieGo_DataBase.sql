/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  18/10/2025 22:00:16                      */
/*==============================================================*/


/*==============================================================*/
/* Table : Administrateur                                       */
/*==============================================================*/
create table Administrateur
(
   id_utilisateur       int not null,
   primary key (id_utilisateur)
);

/*==============================================================*/
/* Table : Avis                                                 */
/*==============================================================*/
create table Avis
(
   id_avis              int not null,
   id_produit           int not null,
   id_utilisateur       int not null,
   note                 int not null,
   commentaire          varchar(254) not null,
   dateAvis             datetime not null,
   primary key (id_avis)
);

/*==============================================================*/
/* Table : Categorie                                            */
/*==============================================================*/
create table Categorie
(
   id_categorie         int not null,
   nom                  varchar(254) not null,
   description          varchar(254) not null,
   primary key (id_categorie)
);

/*==============================================================*/
/* Table : Client                                               */
/*==============================================================*/
create table Client
(
   id_utilisateur       int not null,
   adresse              varchar(254) not null,
   telephone            varchar(254) not null,
   primary key (id_utilisateur)
);

/*==============================================================*/
/* Table : Commande                                             */
/*==============================================================*/
create table Commande
(
   id_commande          int not null,
   id_paiement          int not null,
   id_utilisateur       int not null,
   dateCommande         datetime not null,
   statut               varchar(254) not null,
   total                numeric(8,0) not null,
   primary key (id_commande)
);

/*==============================================================*/
/* Table : LigneCommande                                        */
/*==============================================================*/
create table LigneCommande
(
   id_ligne_commande    int not null,
   id_produit           int not null,
   id_commande          int not null,
   quantite             int not null,
   sousTotal            numeric(8,0) not null,
   primary key (id_ligne_commande)
);

/*==============================================================*/
/* Table : Marque                                               */
/*==============================================================*/
create table Marque
(
   id_marque            int not null,
   nom                  varchar(254) not null,
   paysOrigine          varchar(254) not null,
   primary key (id_marque)
);

/*==============================================================*/
/* Table : Paiement                                             */
/*==============================================================*/
create table Paiement
(
   id_paiement          int not null,
   montant              numeric(8,0) not null,
   modePaiement         varchar(254) not null,
   datePaiement         datetime not null,
   primary key (id_paiement)
);

/*==============================================================*/
/* Table : Produit                                              */
/*==============================================================*/
create table Produit
(
   id_produit           int not null,
   id_categorie         int not null,
   id_promotion         int,
   id_marque            int not null,
   nom                  varchar(254) not null,
   description          varchar(254) not null,
   prix                 numeric(8,0) not null,
   stock                int not null,
   image                varchar(254) not null,
   primary key (id_produit)
);

/*==============================================================*/
/* Table : Promotion                                            */
/*==============================================================*/
create table Promotion
(
   id_promotion         int not null,
   codePromo            varchar(254) not null,
   reduction            numeric(8,0) not null,
   dateDebut            datetime not null,
   dateFin              datetime not null,
   primary key (id_promotion)
);

/*==============================================================*/
/* Table : Utilisateur                                          */
/*==============================================================*/
create table Utilisateur
(
   id_utilisateur       int not null,
   nom                  varchar(254) not null,
   prenom               varchar(254) not null,
   email                varchar(254) not null,
   motDePasse           varchar(254) not null,
   role                 varchar(254) not null,
   dateInscription      datetime not null,
   primary key (id_utilisateur)
);

alter table Administrateur add constraint FK_Generalisation_2 foreign key (id_utilisateur)
      references Utilisateur (id_utilisateur) on delete restrict on update restrict;

alter table Avis add constraint FK_Association_8 foreign key (id_produit)
      references Produit (id_produit) on delete restrict on update restrict;

alter table Avis add constraint FK_Association_9 foreign key (id_utilisateur)
      references Client (id_utilisateur) on delete restrict on update restrict;

alter table Client add constraint FK_Generalisation_1 foreign key (id_utilisateur)
      references Utilisateur (id_utilisateur) on delete restrict on update restrict;

alter table Commande add constraint FK_Association_5 foreign key (id_utilisateur)
      references Client (id_utilisateur) on delete restrict on update restrict;

alter table Commande add constraint FK_Association_7 foreign key (id_paiement)
      references Paiement (id_paiement) on delete restrict on update restrict;

alter table LigneCommande add constraint FK_Association_4 foreign key (id_commande)
      references Commande (id_commande) on delete restrict on update restrict;

alter table LigneCommande add constraint FK_Association_6 foreign key (id_produit)
      references Produit (id_produit) on delete restrict on update restrict;

alter table Produit add constraint FK_Association_1 foreign key (id_categorie)
      references Categorie (id_categorie) on delete restrict on update restrict;

alter table Produit add constraint FK_Association_2 foreign key (id_marque)
      references Marque (id_marque) on delete restrict on update restrict;

alter table Produit add constraint FK_Association_3 foreign key (id_promotion)
      references Promotion (id_promotion) on delete restrict on update restrict;

