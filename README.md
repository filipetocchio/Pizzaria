# Projeto Laravel com Arquitetura SOLID - Filipe Mota Tocchio Rodrigues

Este projeto Laravel foi desenvolvido com uma arquitetura que segue os **princípios SOLID** com o objetivo de melhorar a robustez, a manutenibilidade e a simplicidade do código. Abaixo, segue um resumo das implementações e práticas aplicadas.

## Sumário

- [Princípios SOLID Implementados](#princípios-solid-implementados)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Implementação Técnica](#implementação-técnica)
- [Vantagens](#vantagens)
- [Considerações Finais](#considerações-finais)

## Princípios SOLID Implementados

1. **Single Responsibility Principle (SRP):**  
   Cada classe tem uma responsabilidade única. Controladores lidam exclusivamente com requisições HTTP, os serviços centralizam a lógica de negócios, e os repositórios tratam do acesso a dados.

2. **Open/Closed Principle (OCP):**  
   As classes foram construídas para estarem abertas à extensão, mas fechadas para modificações diretas. A implementação das interfaces e a injeção de dependências facilitam a adição de funcionalidades sem comprometer o código existente.

3. **Liskov Substitution Principle (LSP):**  
   As subclasses substituem suas superclasses sem comprometer o comportamento do sistema. O uso de interfaces garante que as substituições respeitem a consistência.

4. **Interface Segregation Principle (ISP):**  
   Interfaces específicas foram criadas para atender a cada necessidade, evitando interfaces genéricas e amplas, trazendo flexibilidade e clareza.

5. **Dependency Inversion Principle (DIP):**  
   Com foco no desacoplamento, o projeto depende de abstrações (interfaces) ao invés de implementações concretas.

## Estrutura do Projeto

A estrutura da pasta `app` foi reorganizada para incluir camadas dedicadas para Serviços e Repositórios, além das interfaces necessárias. As principais pastas incluem:

- **Http/**
  - Controllers
  - Enums
  - Requests
- **Models/**
- **Providers/**
- **Services/**
  - Contracts
- **Repositories/**
  - Contracts

## Implementação Técnica

### 1. Organização de Pastas

Foram adicionadas novas pastas para uma divisão clara de responsabilidades:

- `Services/Contracts/`: Contém interfaces de serviços.
- `Repositories/Contracts/`: Armazena as interfaces dos repositórios.
- `Services/`: Implementações dos serviços com a lógica de negócios.
- `Repositories/`: Implementações dos repositórios, centralizando operações de banco de dados.

### 2. Definição de Interfaces

Interfaces definem os contratos entre camadas, assegurando que cada serviço e repositório mantenha uma lista específica de operações a serem executadas.

### 3. Repositórios para Acesso a Dados

Repositórios centralizam as operações de acesso ao banco, promovendo a reutilização de código e facilitando a manutenção de interações com o banco de dados.

### 4. Serviços para Lógica de Negócio

Os serviços concentram a lógica de negócios, intermediando a comunicação entre controladores e repositórios.

### 5. Injeção de Dependências

O `AppServiceProvider` foi configurado para mapear interfaces às suas implementações, permitindo a injeção de dependências automática.

### 6. Refatoração dos Controladores

Os controladores foram ajustados para interagir apenas com os serviços, tornando-se responsáveis pelas respostas HTTP e delegando a lógica de negócio aos serviços.

## Vantagens

- **Facilidade de Manutenção:** A organização em camadas permite que mudanças em uma camada afetem minimamente as demais.
- **Melhoria na Testabilidade:** Com serviços e repositórios isolados, os testes são mais simples e o código se torna mais confiável.
- **Facilidade de Expansão:** A adição de funcionalidades não exige a modificação de classes existentes.
- **Reutilização:** O código se torna mais modular e fácil de reutilizar em diferentes áreas do sistema.
- **Desacoplamento:** O uso de injeção de dependências e interfaces reduz o acoplamento e facilita adaptações.

## Considerações Finais

Aplicar os princípios **SOLID** nesta arquitetura Laravel proporcionou uma estrutura de código mais organizada e sustentável. A separação clara entre **Controladores**, **Serviços** e **Repositórios** contribuiu para uma manutenção mais ágil e evoluções do sistema de forma facilitada.