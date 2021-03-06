<?php

##idea.licenca##

class Ideasa_IdeCheckoutvm_Helper_Data extends Mage_Core_Helper_Abstract {

    public function isCheckoutEnabled() {
        return Mage::getStoreConfigFlag('idecheckoutvm/geral/active');
    }

    public function getAgreeIds() {
        if (!Mage::helper('idecheckoutvm/checkout')->isAgreementsEnable()) {
            return null;
        }
        $agree = Mage::getModel('checkout/agreement')->getCollection()
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->addFieldToFilter('is_active', 1)
                ->getAllIds();
        return $agree;
    }

    public function getVersion() {
        return (string) Mage::getConfig()->getNode()->modules->Ideasa_IdeCheckoutvm->version;
    }

    // FIXME: verificar se há o módulo
    public function isAutocompleteCepEnable() {
        return Mage::getStoreConfigFlag(Ideasa_IdeAddons_ConfiguracoesSystem::AUTOCOMPLETE_CEP);
    }

    // FIXME: verificar se há o módulo
    public function isLinkCepEnable() {
        return Mage::getStoreConfigFlag(Ideasa_IdeAddons_ConfiguracoesSystem::SHOW_LINK_CEP);
    }

    public function mascararCep($cep) {
        if (!is_null($cep)) {
            $cep = str_replace('-', '', $cep);
            $number1 = substr($cep, 0, 5);
            $number2 = substr($cep, 5, 3);
            
            return $number1 . '-' . $number2;
        }
        return null;
    }

}